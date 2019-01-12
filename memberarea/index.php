<?php 
session_start(); 
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Selamat Datang Di Member Area - UKM Hotel</title>
		<link rel="stylesheet" type="text/css" href="<?php echo "http://$_SERVER[HTTP_HOST]";?>/memberarea/asset/style.css" />
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
                <div id="mainkonten"><table width=100%><tr><td>
				<p>&nbsp;</p>
				<p>Selamat Bergabung!</p>
				<p align='right' class="style3">Kepada,<br>
				Yth: Bpk/Ibu. <?php echo $_SESSION['member']['nama_lengkap']; ?> <br>
				di. <?php echo $_SESSION['member']['propinsi']; ?></p>

				<p class="style3">Terima kasih atas kepercayaan yang anda berikan.Mari bersama membangun perekonomian bangsa ini dan membantu memberikan peluang usaha kepada orang lain. Berikut adalah data yang anda input kedalam data base kami :</p>

				<table border=0 width="100%" class="style3">
				<tr><td width="30%">Tanggal Aktif</td><td> : <?php echo $_SESSION['member']['tanggal_aktif']; ?> </td> </tr>
				<tr><td width="30%">ID Keanggotaan</td><td> : <?php echo $_SESSION['member']['id']; ?> </td> </tr>
				<tr><td width="30%">Nama </td><td> : <?php echo $_SESSION['member']['nama_lengkap']; ?> </td> </tr>
				<tr><td width="30%" style="width:'30px'; overflow:'hidden';">Alamat </td><td> : <?php echo $_SESSION['member']['alamat']; ?> </td> </tr>
				<tr><td width="30%">Kota </td><td> : <?php echo $_SESSION['member']['kota']; ?> </td> </tr>
				<tr><td width="30%">Propinsi </td><td> : <?php echo $_SESSION['member']['propinsi']; ?> </td> </tr>
				<tr><td colspan="2">&nbsp;</td> </tr>
				<tr><td width="30%">Handphone </td><td> : <?php echo $_SESSION['member']['handphone']; ?> </td> </tr>
				<tr><td colspan="2">&nbsp;</td> </tr>
				<tr><td width="30%">Nama Bank </td><td> : <?php echo $_SESSION['member']['bank']; ?> </td> </tr>
				<tr><td width="30%">Pemilik </td><td> : <?php echo $_SESSION['member']['atas_nama']; ?> </td> </tr>
				<tr><td width="30%">Rekening </td><td> : <?php echo $_SESSION['member']['no_rekening']; ?> </td> </tr>
				<tr><td colspan="2">&nbsp;</td> </tr>
				<tr><td width="30%">Sponsor </td><td> : [ <?php echo $_SESSION['member']['sponsor']; ?> ]  </td> </tr>
				<tr><td width="30%">Upline </td><td> : [ <?php echo $_SESSION['member']['upline']; ?> ]  </td> </tr>

				</table>
				<p class="style3">Semoga bisnis yang dahsyat ini dapat memberi kesejahteraan kita bersama. </p>
				 
				<p class="style3">Sebagai bahan promosi Anda mendapatkan web reflika sebagai berikut. </p>

				 <p align=center><b> <?php echo "http://$_SERVER[HTTP_HOST]/?id="; echo $_SESSION['member']['id']; ?> </b></p>
				   
				<p class="style3" style="margin-bottom:0px;">SALAM SUKSES </p> 
				<p class="style3" style="margin-top:0px;">PT. MENTARI MANUNGGAL MANDIRI (JAKARTA)</p> 	  
				   
				<p><strong>Drs. H. Jufri<br>DIREKTUR PT CAHAYA KOTABARU (JAMBI)</strong></p> 
				</td></tr>
				</table>
								</div>
								<div class="clear"></div>
            </div>
            <div id="footer">
                Copyright &COPY; 2017-<?php echo date("Y") ?> - <a href=<?php echo "http://$_SERVER[HTTP_HOST]/";?>>UKM Hotel</a>
            </div>
        </div>
    </body>
</html>
