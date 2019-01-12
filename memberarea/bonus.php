<?php
session_start();
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}

require_once("./include/bonushandler.php");
$handler = new BonusHandler();
$handler->GetBonusRincian($_SESSION['member']['id']);
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
					<tr><td><HR></td></tr>
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
					<tr><td><HR></td></tr>
				</table>
				<p align="center">INFORMASI PERKEMBANGAN BONUS</p>
					<table align="center" bgcolor="#cccccc" cellpadding="2" cellspacing="1" width="100%" class="style3">
					<tbody>
						<tr align="center" background="images/back.jpg">
							<td height="27"><strong><font color="#ffffff">Jenis Bonus</font></strong></td>
							<td ><span class="style2"><font color="#ffffff">Hari ini</span></td>
							<td ><span class="style2"><font color="#ffffff">Minggu ini</span></td>
							<td ><span class="style2"><font color="#ffffff">Akumulasi</span></td>
						</tr>
						<tr bgcolor="#ccffff">
							<td  align="left" bgcolor="#ffffff" height="20">BONUS SPONSOR</td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->todaybonus['sponsor']); ?></td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->weeklybonus['0']); ?></td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->akumulasibonus['totalsponsor']); ?></td>
						</tr>
						<tr bgcolor="#ccffff">
							<td  align="left" bgcolor="#ffffff" height="20">BONUS PASANGAN</td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->todaybonus['pasangan']); ?></td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->weeklybonus['1']); ?></td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->akumulasibonus['totalpasangan']); ?></td>
						</tr>
						<tr bgcolor="#ccffff">
							<td align="left" bgcolor="#ffffff" height="20">BONUS MATCHING</td>
							<td align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->todaybonus['matching']); ?></td>
							<td align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->weeklybonus['2']); ?></td>
							 <td align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->akumulasibonus['totalmatching']); ?></td>
						</tr>
						<tr bgcolor="#ccffff">
							<td  align="left" bgcolor="#ffffff" height="20">BONUS TITIK</td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->todaybonus['titik']); ?></td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->weeklybonus['3']); ?></td>
							<td  align="right" bgcolor="#ffffff" height="20">Rp <?php echo $handler->formatRupiah($handler->akumulasibonus['totaltitik']); ?></td>
						</tr>
						<tr align="right"  background="images/back.jpg">
							<td height="27"><strong><font color="#ffffff">TOTAL</font></strong></td>
							<td ><span class="style2"><font color="#ffffff">Rp <?php echo $handler->formatRupiah($handler->todaybonus['total']); ?></span></td>
							<td ><span class="style2"><font color="#ffffff">Rp <?php echo $handler->formatRupiah($handler->weeklybonus['4']); ?></span></td>
							<td ><span class="style2"><font color="#ffffff">Rp <?php echo $handler->formatRupiah($handler->akumulasibonus['total']); ?></span></td>
						</tr>
					</tbody>
					</table>
					<p>&nbsp;</p>
					<p align='center'>RINCIAN BONUS HARIAN PERIODE MINGGU INI</p>
					<table align='center' bgcolor='#cccccc' cellpadding='2' cellspacing='1' width='100%' class='style3'>
						<tr align='center' background='images/back.jpg'>
							<td width=20% >TANGGAL</td>
							<td width=20% align='right'>SPONSOR</td>
							<td width=20% align='right'>PASANGAN</td>
							<td width=20% align='right'>MATCHING</td>
							<td width=20% align='right'>TITIK</td>
						</tr>
						
						<?php 
							$totalsponsor = 0;
							$totalpasangan = 0;
							$totalmatching = 0;
							$totaltitik = 0;
							if($handler->bonusrincian[0] != array()){
								for($i = 0; $i < count($handler->bonusrincian); $i++){
									$rincian = $handler->bonusrincian[$i];
									$totalsponsor = $totalsponsor + $rincian['sponsor'];
									$totalpasangan = $totalpasangan + $rincian['pasangan'];
									$totalmatching = $totalmatching + $rincian['matching'];
									$totaltitik = $totaltitik + $rincian['titik'];
									echo "
									<tr align='left'>
										<td width=20% bgcolor='#ffffff'>".$rincian['tanggal']."</td>
										<td width=20% align='right' bgcolor='#ffffff'>Rp ".$handler->formatRupiah($rincian['sponsor'])."</td>
										<td width=20% align='right' bgcolor='#ffffff'>Rp ".$handler->formatRupiah($rincian['pasangan'])."</td>
										<td width=20% align='right' bgcolor='#ffffff'>Rp ".$handler->formatRupiah($rincian['matching'])."</td>
										<td width=20% align='right' bgcolor='#ffffff'>Rp ".$handler->formatRupiah($rincian['titik'])."</td>
									</tr>
									";
								}
								$totalbonus = $totalsponsor + $totalpasangan + $totalmatching + $totaltitik;
							}else{
								$totalbonus = 0;
							}
						
						?>
						
						<tr align='center' background='images/back.jpg'>
							<td width=20% >JUMLAH</td>
							<td width=20% align='right'>Rp <?php echo $handler->formatRupiah($totalsponsor); ?></td>
							<td width=20% align='right'>Rp <?php echo $handler->formatRupiah($totalpasangan); ?></td>
							<td width=20% align='right'>Rp <?php echo $handler->formatRupiah($totalmatching); ?></td>
							<td width=20% align='right'>Rp <?php echo $handler->formatRupiah($totaltitik); ?></td>
						</tr>
					</table>
					<p align='center'>TOTAL BONUS ANDA MINGGU INI:<strong> Rp <?php echo $handler->formatRupiah($totalbonus); ?></strong></p>
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
