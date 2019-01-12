<?php

require_once("./../include/db.php");

$recovery = new MemberRecovery();
$recovery->recoverMember();

class MemberRecovery {

  function MemberRecovery() {
    $this->db = new Database();
    $this->connection = $this->db->getConnection();
  }

  function recoverMember() {
    // SELECT * FROM `data_id` WHERE status = '1' AND id NOT IN ( SELECT `id` FROM `member` )
    // SELECT * FROM `data_id` LEFT JOIN `member` ON `data_id`.`id` = `member`.`id` WHERE `data_id`.`status` = 1 AND `member`.`id`IS NULL

    $memberData = array();

    $sql = "SELECT * FROM `data_id` WHERE status = '1' AND id NOT IN ( SELECT `id` FROM `member` );";
    $result = $this->connection->query($sql);
    if ($result->num_rows == 0) return;   // No missing member found

    // Assign the ID
    for ($i = 0; $i < $result->num_rows; $i++) {
      $row = $result->fetch_assoc();
      $member = new Member();
      $member->id = $row["id"];
      $memberData[$member->id] = $member;
    }

    $this->findUpline($memberData, 'downline_kiri', 'kiri');
    $this->findUpline($memberData, 'downline_kanan', 'kanan');
    $this->findSponsor($memberData);
    $this->insertMember($memberData);

    echo "<pre>";
    print_r($memberData);
    echo "</pre>";
  }

  function findUpline($memberData, $downline_type, $posisi) {
    // Construct Missing IDs
    $missing_ids = "'" . implode("','", array_keys($memberData)) . "'";

    // Find Upline
    $sql = "SELECT * FROM `member` WHERE $downline_type IN (" . $missing_ids . ")";
    $result = $this->connection->query($sql);

    // Return if no result
    if (!$result) return;

    // Set Upline
    while ($row = $result->fetch_assoc()) {
      $upline_id = $row['id'];
      $downline_id = $row[$downline_type];
      $memberData[$downline_id]->upline = $upline_id;
      $memberData[$downline_id]->posisi = $posisi;

      // echo "<pre>";
      // print_r($row);
      // print_r($memberData[$downline_id]);
      // echo "</pre>";
    }

  }

  function findSponsor($memberData) {
    // Find sponsor, Tanggal Aktif
    $sql = "SELECT * FROM `bonus_history` WHERE idsponsor like ?";
    $stmt = $this->connection->prepare($sql);

    foreach ($memberData as $member) {
      $stmt->bind_param("s", $id);
      $id = '%'.$member->id.'%';
      $stmt->execute();

      $result = $stmt->get_result();
      if ($result->num_rows === 0) continue;
      $row = $result->fetch_assoc();
      // echo "<pre>";
      // print_r($row);
      // echo "</pre>";

      $member->sponsor = $row["member_id"];
      $member->tanggalAktif = $row["tanggal"];
    }
  }

  function insertMember($memberData) {
    $sql = "INSERT INTO `member`
    (`id`, `sponsor`, `upline`, `posisi`, `tanggal_aktif`, `nama_lengkap`, `password`)
    VALUES
    (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connection->prepare($sql);

    foreach ($memberData as $member) {
      $stmt->bind_param("sssssss", $member->id, $member->sponsor, $member->upline,
          $member->posisi, $member->tanggalAktif, $member->namaLengkap, $member->password);
      $success = $stmt->execute();
	  if ($success) {
		echo "<br> inserted";
	  } else {
		echo "<br> " . $stmt->error;  
	  }
	}
  }

}

class Member {

  var $id;
  var $sponsor;
  var $upline;
  var $posisi;
  var $tanggalAktif;
  var $namaLengkap;
  var $password;

  function Member() {
    $this->namaLengkap = 'ECOPLUS';
    $this->password = 'ECOPLUS';
  }

}

?>
