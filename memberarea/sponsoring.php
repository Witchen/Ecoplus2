<?php 
session_start();
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}

require_once("./include/sponsorhandler.php");
$handler = new SponsorHandler();	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Selamat Datang Di Member Area - UKM Hotel</title>
        <link rel="stylesheet" type="text/css" href="asset/style.css" />
    </head>
    <body>
        <div id="kontainer">
            <div id="header"></div>
            <div id="menu">
                <div id="box1"></div>
                <div class="box-menu"><a href="index.php"><img src="asset/home-button.png" /></a></div>
                <div class="box-menu"><a href="editprofile.php"><img src="asset/profil-button.png" /></a></div>
                <div class="box-menu"><a href="editprofile.php"><img src="asset/pass-button.png" /></a></div>
                <div class="box-menu"><a href="logout.php"><img src="asset/logout-button.png" /></a></div>
                <div class="clear"></div>
            </div>
            <div id="konten">
                <div id="sidebar">
                    <div class="header-box"><b>MENU UTAMA</b></div>
                    <div class="isi-box">
                        <ul class="menu-sd">
                            <li class="back"><a href="index.php">Home</a></li>
                            <li class="back"><a href="editprofile.php">Edit Profile</a></li>
                            <li class="back"><a href="sponsoring.php">Sponsoring</a></li>
                            <li class="back"><a href="registrasi.php">Registrasi Mitra</a></li>
                            <li class="back"><a href="viewtree.php">Genealogy</a></li>
                            <li class="back"><a href="bonus.php">Bonus</a></li>
                            <li class="back"><a href="statemen.php">Statemen Bonus</a></li>
							<li class="back"><a href="statemenhistoris.php">Statemen Historis</a></li>
                            <li class="back"><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    
                </div>
                
                <div id="mainkonten"><table width=100%><tr><td><HR></td></tr>
<tr><td>
<table align="center" border=0 width="80%" class="style3">
<tr><td width="30%">Tanggal Aktif</td><td> :<b> <?php echo $_SESSION['member']['tanggal_aktif']; ?> </b></td> </tr>
<tr><td width="30%">ID Keanggotaan</td><td> :<b> <?php echo $_SESSION['member']['id']; ?> </b></td> </tr>
<tr><td width="30%">Nama </td><td> :<b> <?php echo $_SESSION['member']['nama_lengkap']; ?> </b></td> </tr>
<tr><td width="30%">Kota </td><td> : <b> <?php echo $_SESSION['member']['kota']; ?> </b></td> </tr>
<tr><td width="30%">Handphone </td><td> : <b> <?php echo $_SESSION['member']['handphone']; ?> </b></td> </tr>
<tr><td width="30%">Sponsor </td><td> : <b> [ <?php echo $_SESSION['member']['sponsor']; ?> ]  </b></td> </tr>
<tr><td width="30%">Upline </td><td> : <b> [ <?php echo $_SESSION['member']['upline']; ?> ]  </b></td> </tr>
</table>
</td></tr>
<tr><td><HR></td></tr>
</table>
<p align="center">DAFTAR MEMBER SPONSOR LANGSUNG ANDA</p>
<table align="center" bgcolor="#cccccc" cellpadding="2" cellspacing="1" width="90%" class="style3">
  
  <tbody>
  <tr align="center" background="images/back.jpg">
    <td height="27"><strong><font color="#ffffff">No</font></strong></td>
    <td width="20%"><span class="style2"><font color="#ffffff">ID Member</span></td>
    <td ><span class="style2"><font color="#ffffff">Nama</span></td>
	<td ><span class="style2"><font color="#ffffff">Tanggal Aktif</span></td>
    <td ><span class="style2"><font color="#ffffff">Kota</span></td>
  </tr>

  <?php 
  
	$result = $handler->GetAllSponsorData($_SESSION['member']['id']);
	$count = 0;
	while($row = $result->fetch_assoc()){
		$count++;
		echo "
		
		<tr bgcolor='#ccffff'>
			<td  align='center' bgcolor='#ffffff' height='20'>$count </td>
			<td  bgcolor='#ffffff' height='20'>".$row['id']."</td>
			<td  bgcolor='#ffffff' height='20'>".$row['nama_lengkap']."</td>
			<td  bgcolor='#ffffff' height='20'>".$row['tanggal_aktif']."</td>
			<td  bgcolor='#ffffff' height='20'>".$row['kota']."</td>
		</tr>
		
		";
	}
  
  ?>
  
	</tbody>
</table>

<p>&nbsp;</p>

                </div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                Copyright &COPY; 2017-<?php echo date("Y") ?> - <a href=<?php echo "http://$_SERVER[HTTP_HOST]/";?>>UKM Hotel</a>
            </div>
        </div>
    </body>
</html>
