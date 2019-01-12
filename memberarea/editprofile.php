<?php 
session_start();
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}

require_once("./include/edithandler.php");
$handler = new EditHandler();
if(isset($_POST['vsubmit'])){
	$handler->CheckData();
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
                
                <div id="mainkonten">
					<table align="center" width="90%">
						<tr>
							<td>
								<p align="center" class="style3"><strong>EDIT MEMBER</strong></p>
							</td>
						</tr>
						<tr><td><br></td></tr>

 <table align="center" bgcolor="#ffffff" cellpadding="2" cellspacing="1" width="90%" class="style3">
  <form method="POST" action="editprofile.php" name="formcek">
  <tbody>
  <?php 
  
	if($handler->statusupdate != ""){
		if($handler->statusupdate == "**Sukses: Data telah di update!**"){
			echo "
			<tr>
				<th height='29' colspan='2' style='background-color: #17b217' align='center'><font color='#ffffff'>$handler->statusupdate</font></th>
			</tr>
			";  
		}else{
			echo "
			<tr>
				<th height='29' colspan='2' style='background-color: #ff0000' align='center'><font color='#ffffff'>$handler->statusupdate</font></th>
			</tr>
			";
		}
	}
  
  ?>
  <!-- CCD0E0 -->
     <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">ID Kartu (CardNumber)**</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff" color="#0000FF"><input type="text" disabled value="<?php echo $_SESSION['member']['id']; ?>" name="vcardnumber" size=8 maxlength=7 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #CCD0E0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">PIN Kartu (Card PIN)**</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vcardpin" value="" autocomplete="off" size=8 maxlength=6 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->pin; ?> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">ID Sponsor **</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vidsponsor" disabled value="<?php echo $_SESSION['member']['sponsor']; ?>" size=8 maxlength=7 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #CCD0E0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">ID Upline **</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vidupline" disabled value="<?php echo $_SESSION['member']['upline']; ?>" size=8 maxlength=7 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #CCD0E0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Posisi **</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="radio" name="vposisi" disabled value="kiri" <?php if($_SESSION['member']['posisi'] == "kiri"){echo "checked";} ?> style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Kiri <input type="radio" name="vposisi" disabled value="kanan" <?php if($_SESSION['member']['posisi'] == "kanan"){echo "checked";} ?> style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Kanan </td>
  </tr>
   <tr>
    <td colspan='2' bgcolor="#ffffff">&nbsp; </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Nama Lengkap *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vnama" value="<?php echo $_SESSION['member']['nama_lengkap']; ?>"  style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Password *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="password" name="vpassword" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->password; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">No KTP/SIM/PASPORT *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vktp" value="<?php echo $_SESSION['member']['ktp']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">NPWP </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vnpwp" value="<?php echo $_SESSION['member']['npwp']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Tanggal Lahir </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vtgllahir" value="<?php echo $_SESSION['member']['tanggal_lahir']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> <font color="#000000"> <?php echo $handler->tanggal; ?>  </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Jenis Kelamin </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="radio" name="vkelamin" value="laki-laki" <?php if($_SESSION['member']['kelamin'] == "laki-laki"){echo "checked";} ?> style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Laki-laki <input type="radio" name="vkelamin" <?php if($_SESSION['member']['kelamin'] == "perempuan"){echo "checked";} ?> value="perempuan" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Perempuan </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Alamat </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="valamat" value="<?php echo $_SESSION['member']['alamat']; ?>" size=30 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Kota </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vkota" value="<?php echo $_SESSION['member']['kota']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Propinsi </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vpropinsi" value="<?php echo $_SESSION['member']['propinsi']; ?>" size=15 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> Kode Pos <input type="text" name="vkodepos" value="<?php echo $_SESSION['member']['kodepos']; ?>" size=5 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Email </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vemail" value="<?php echo $_SESSION['member']['email']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Telepon </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vtelepon" value="<?php echo $_SESSION['member']['telepon']; ?>" size=15  style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Handphone *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vhphone" size=15 value="<?php echo $_SESSION['member']['handphone']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->hp; ?></font></td>
  </tr>
   <tr>
    <td colspan='2' bgcolor="#ffffff">&nbsp; </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Bank dan Cabang *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vbank" value="<?php echo $_SESSION['member']['bank']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->bank; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Atas Nama *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vatasnama" value="<?php echo $_SESSION['member']['atas_nama']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->atasnama; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">No Rekening *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vrekening" value="<?php echo $_SESSION['member']['no_rekening']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->norek; ?> </font></td>
  </tr>
   <tr>
    <td colspan='2' bgcolor="#ffffff">&nbsp; </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Nama Ahli Waris</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vahliwaris" value="<?php echo $_SESSION['member']['nama_ahli_waris']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Hubungan Ahli Waris </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vhubahliwaris" value="<?php echo $_SESSION['member']['hubungan_ahli_waris']; ?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
  </tr>
   <tr>
    <td align="center" colspan='2' bgcolor="#ffffff">**SILAHKAN DI PERIKSA KEMBALI SEBELUM DI AKTIFKAN<br>SEGALA HASIL DARI AKTIVASI INI TIDAK DAPAT DIBATALKAN**</td>
  </tr>
   <tr>
    <td align="center" colspan='2' bgcolor="#ffffff"><input type="submit" name="vsubmit"  value=" AKTIFKAN " style="font-family: Arial; color: #FFFFFF; font-size: 10pt; font-weight: bold; border: 1px solid #A096C5; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color:#000000"></td>
  </tr>
</tbody></table>
</form>
<p>&nbsp;</p>
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
