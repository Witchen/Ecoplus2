<?php 
session_start();
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}

require_once("./include/statemenhistorishandler.php");
$handler = new StatemenHandler();
$bonusperiode = $handler->GetStatementPeriodeAkhir();
$totalbonusperiode1 = $bonusperiode['totalsponsor']+$bonusperiode['totalpasangan']+$bonusperiode['totalmatching']+$bonusperiode['totaltitik'];
$totalpajak6persen = $totalbonusperiode1 * 6 / 100;
$biayamaintenance = 10000;
$totalbonusperiode2 = $totalbonusperiode1 - $totalpajak6persen - $biayamaintenance;
$totalakumulasibonus = $handler->GetAkumulasi($_SESSION['member']['id']);
// if($totalakumulasibonus < 4000000){
	// $totalakumulasibonus = $totalakumulasibonus / 2;
	// $bonus50persen = $totalbonusperiode2 * 50 / 100;
	// $bonus100persen = 0;
// }else{
	// $previousbonus = $handler->CheckPreviousPeriodBonus();
	// if($previousbonus != 0){	//if member have previous bonus
		// if($previousbonus < 4000000){	//  if the current period make bonus exceed 4,000,000
			// $sisabonusuntukditabung = 4000000 - $previousbonus; //akan di kali dengan 50% dan ditampilkan di kolom 50%
			// $bonus50persen = $sisabonusuntukditabung / 2;
			// $bonus100persen = $totalbonusperiode2 - $sisabonusuntukditabung; //akan di tampilkan di kolom 100%
		// }else{	//else previous period bonus already exceed 4,000,000
			// $bonus50persen = 0;
			// $bonus100persen = $totalbonusperiode2;
		// }
	// }else{	//else member get 4,000,000 bonus in one and only one statement(first bonus)
		// // 50 % print 2,000,000
		// // 100 % print sisa
		// $bonus50persen = 0;
		// $bonus100persen = $totalbonusperiode2 - 2000000;
	// }
// }
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
                
                <div id="mainkonten">
				<table width=100%>
					<tr>
						<td><HR></td>
					</tr>
					<tr>
						<td>
							<table align="center" border=0 width="80%" class="style3">
								<tr><td width="30%">Tanggal Aktif</td><td> :<b> <?php echo $_SESSION['member']['tanggal_aktif']; ?> </b></td> </tr>
								<tr><td width="30%">ID Keanggotaan</td><td> :<b> <?php echo $_SESSION['member']['id']; ?> </b></td> </tr>
								<tr><td width="30%">Nama </td><td> :<b> <?php echo $_SESSION['member']['nama_lengkap']; ?> </b></td> </tr>
								<tr><td width="30%">Kota </td><td> : <b> <?php echo $_SESSION['member']['kota']; ?> </b></td> </tr>
								<tr><td width="30%">Handphone </td><td> : <b> <?php echo $_SESSION['member']['handphone']; ?> </b></td> </tr>
								<tr><td width="30%">Sponsor </td><td> : <b> [ <?php echo $_SESSION['member']['sponsor']; ?> ]  </b></td> </tr>
								<tr><td width="30%">Upline </td><td> : <b> [ <?php echo $_SESSION['member']['upline']; ?> ]  </b></td> </tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><HR></td>
					</tr>
				</table>

				<table width='100%'>
					<tr align ='center'>
						<td>
							<table width='80%' border='1'>
							<tr align='center'>
								<td>Statemen Bonus Periode: <?php echo $bonusperiode['tanggal'] ?></td>
							</tr>
							<tr>
								<td>
									<table align='center' width='80%'>
										<tr>
											<td align='left' width='40%'>Bonus Sponsor</td>
											<td align='left' width='20%'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($bonusperiode['totalsponsor']); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Bonus Pasangan</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($bonusperiode['totalpasangan']); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Bonus Matching</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($bonusperiode['totalmatching']); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Bonus Titik</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($bonusperiode['totaltitik']); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td colspan='2' align='right' width='50%'>+</td>
											<td align='left'><HR></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Total (I)</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($totalbonusperiode1); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Pajak PPH (6%)</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($totalpajak6persen); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Biaya</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($biayamaintenance); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td colspan='2' align='right'>-</td>
											<td align='left'><HR></td>
										</tr>
										<tr>
											<td align='left' width='40%'>Total (II)</td>
											<td align='left'>: Rp</td>
											<td align='right'><?php if(isset($bonusperiode)){ echo $handler->formatRupiah($totalbonusperiode2); } else{ echo "0"; } ?></td>
										</tr>
										<tr>
											<td colspan='3'><hr></td>
										</tr>
										<tr>
											<td colspan='3' align='left'><strong>Data Bank Anda:</strong></td>
										</tr>
										<tr>
											<td align='left'>Nama Bank</td>
											<td align='left'>:</td>
											<td align='right'><?php echo $_SESSION['member']['bank'] ?></td>
										</tr>
										<tr>
											<td align='left'>Atas Nama</td>
											<td align='left'>:</td>
											<td align='right'><?php echo $_SESSION['member']['atas_nama'] ?></td>
										</tr>
										<tr>
											<td align='left'>No. Rekening</td>
											<td align='left'>:</td>
											<td align='right'><?php echo $_SESSION['member']['no_rekening'] ?></td>
										</tr>
										<tr>
											<td colspan='3'><hr></td>
										</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
				</table>
				<p>&nbsp;</p>
                </div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                Copyright &COPY; 2017-<?php echo date("Y") ?> - <a href=<?php echo "http://$_SERVER[HTTP_HOST]/";?>>UKM Hotel</a>
            </div>
        </div>
    <script>
		function updatebulan(tahun){
			document.body.innerHTML += '<form method="POST" action="statemen.php" id="updatebulan"><input type="hidden" name="tahun" value="'+tahun.value+'"></form>';
			document.getElementById("updatebulan").submit();
		}
		function updateperiode(bulan, tahun){
			document.body.innerHTML += '<form method="POST" action="statemen.php" id="updateperiode"><input type="hidden" name="bulan" value="'+bulan.value+'"><input type="hidden" name="tahun" value="'+tahun.value+'"></form>';
			document.getElementById("updateperiode").submit();
		}
	</script>
	</body>
</html>
