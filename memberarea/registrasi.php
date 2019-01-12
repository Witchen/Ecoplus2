<?php 
session_start();
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}

require_once("./include/registrationhandler.php");
$handler = new RegistrationHandler();
if(isset($_POST['vsubmit'])){
	$handler->CheckData();
}
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
                
                <div id="mainkonten"><script language="javascript">
<!--
function viewupline()
{
  window.open( "browseview.php?idna=" + formcek.vidupline.value , "_blank","width=420, height=125")
}

function viewsponsor()
{
  window.open( "browseview.php?idna=" + formcek.vidsponsor.value , "_blank","width=420, height=125")
}
-->

</script>

<table width=100% class="style3"><tr><td><HR></td></tr>
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

<p align="center" class="style3"><strong>AKTIVASI MEMBER</strong><br>Silahkan isi form berikut dengan lengkap, benar dan sesuai kartu identitas<br>
 (KTP/SIM/Passport) yang masih berlaku untuk mengaktifkan keanggotaan anda<br>
bagian bertanda (*) harus diisi<br></p>
 <table align="center" bgcolor="#ffffff" cellpadding="2" cellspacing="1" width="90%" class="style3">
  <form method="POST" action="registrasi.php" name="formcek">
  <tbody>
  <?php 
  
	if($handler->statusregistrasi != ""){
		if($handler->statusregistrasi == "**Registrasi Member Sukses**"){
			echo "
			<tr>
				<th height='29' colspan='2' style='background-color: #17b217' align='center'><font color='#ffffff'>$handler->statusregistrasi</font></th>
			</tr>
			";  
		}else{
			echo "
			<tr>
				<th height='29' colspan='2' style='background-color: #ff0000' align='center'><font color='#ffffff'>$handler->statusregistrasi</font></th>
			</tr>
			";
		}
	}
  
  ?>
	
	<tr  background="images/back.jpg">
		<td align="right" width="30%" height="27"><strong><font color="#000000">ID Kartu (CardNumber)**</font></strong></td>
		<td align="left" width="70%" bgcolor="#ffffff" color="#0000FF"><input type="text" value="<?php if(isset($_POST['vcardnumber'])){echo $_POST['vcardnumber'];}?>" name="vcardnumber" size=8 maxlength=7 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->card; ?> </font></td>
	</tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">PIN Kartu (Card PIN)**</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vcardpin" value="<?php if(isset($_POST['vcardpin'])){echo $_POST['vcardpin'];}?>" autocomplete="off" size=8 maxlength=6 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->pin; ?> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">ID Sponsor **</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vidsponsor" value="<?php if(isset($_GET['sp']) && isset($_GET['up'])){echo $_GET['sp'];} elseif(isset($_POST['vidsponsor'])){echo $_POST['vidsponsor'];}else{echo $_SESSION['member']['id'];}?>" size=8 maxlength=7 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">  <input value="Cek Sponsor" onclick="viewsponsor()" type="button" style="width:95px"> <font color="#ff0000"> <?php echo $handler->sponsor; ?> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">ID Upline **</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vidupline" value="<?php if(isset($_GET['sp']) && isset($_GET['up'])){echo $_GET['up'];} elseif(isset($_POST['vidupline'])){echo $_POST['vidupline'];}else{echo $_SESSION['member']['id'];}?>" size=8 maxlength=7 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">  <input value="Cek Upline" onclick="viewupline()" type="button" style="width:95px"> <font color="#ff0000"> <?php echo $handler->upline; ?> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Posisi **</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="radio" name="vposisi" value="kiri" <?php if(isset($_GET['posisi'])){if($_GET['posisi'] == "kiri"){echo "checked";}} else{echo "checked";} ?> style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Kiri <input type="radio" name="vposisi" value="kanan" <?php if(isset($_GET['posisi'])){if($_GET['posisi'] == "kanan"){echo "checked";}} ?> style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Kanan   <font color="#ff0000"> <?php echo $handler->posisi; ?> </td>
  </tr>
   <tr>
    <td colspan='2' bgcolor="#ffffff">&nbsp; </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Nama Lengkap *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vnama" value="<?php if(isset($_POST['vnama'])){echo $_POST['vnama'];}?>"  style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->namalengkap; ?> </font></td>
  </tr>
  <!--
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Nama Panggilan </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vnamapanggil" value="<?php if(isset($_POST['vnamapanggil'])){echo $_POST['vnamapanggil'];}?>"  style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
  </tr>
  -->
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Password *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="password" name="vpassword" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->password; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">No KTP/SIM/PASPORT *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vktp" value="<?php if(isset($_POST['vktp'])){echo $_POST['vktp'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->noktp; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">NPWP </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vnpwp" value="<?php if(isset($_POST['vnpwp'])){echo $_POST['vnpwp'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Tanggal Lahir </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vtgllahir" value="<?php if(isset($_POST['vtgllahir'])){echo $_POST['vtgllahir'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> <font color="#000000"> <?php echo $handler->tanggal; ?>  </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Jenis Kelamin </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="radio" name="vkelamin" value="laki-laki" checked style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Laki-laki <input type="radio" name="vkelamin"  value="perempuan" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0">Perempuan </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Alamat </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="valamat" value="<?php if(isset($_POST['valamat'])){echo $_POST['valamat'];}?>" size=30 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Kota *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vkota" value="<?php if(isset($_POST['vkota'])){echo $_POST['vkota'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->kota; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Propinsi </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vpropinsi" value="<?php if(isset($_POST['vpropinsi'])){echo $_POST['vpropinsi'];}?>" size=15 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> Kode Pos <input type="text" name="vkodepos" size=5 style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Email </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vemail" value="<?php if(isset($_POST['vemail'])){echo $_POST['vemail'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Telepon </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vtelepon" value="<?php if(isset($_POST['vetelepon'])){echo $_POST['vtelepon'];}?>" size=15  style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Handphone *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vhphone" size=15 value="<?php if(isset($_POST['vhphone'])){echo $_POST['vhphone'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->hp; ?></font></td>
  </tr>
   <tr>
    <td colspan='2' bgcolor="#ffffff">&nbsp; </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Bank dan Cabang *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vbank" value="<?php if(isset($_POST['vbank'])){echo $_POST['vbank'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->bank; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Atas Nama *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vatasnama" value="<?php if(isset($_POST['vatasnama'])){echo $_POST['vatasnama'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->atasnama; ?> </font></td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">No Rekening *</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vrekening" value="<?php if(isset($_POST['vrekening'])){echo $_POST['vrekening'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"><font color="#ff0000"> <?php echo $handler->norek; ?> </font></td>
  </tr>
   <tr>
    <td colspan='2' bgcolor="#ffffff">&nbsp; </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Nama Ahli Waris</font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vahliwaris" value="<?php if(isset($_POST['vahliwaris'])){echo $_POST['vahliwaris'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
  </tr>
   <tr  background="images/back.jpg">
    <td align="right" width="30%" height="27"><strong><font color="#000000">Hubungan Ahli Waris </font></strong></td>
    <td align="left" width="70%" bgcolor="#ffffff"><input type="text" name="vhubahliwaris" value="<?php if(isset($_POST['vhubahliwaris'])){echo $_POST['vhubahliwaris'];}?>" style="font-family: Arial; color: #0000FF; font-size: 10pt; font-weight: normal; border: 1px solid #00FF00; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFC0"> </td>
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

                </div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                Copyright &COPY; 2017-<?php echo date("Y") ?> - <a href=<?php echo "http://$_SERVER[HTTP_HOST]/";?>>UKM Hotel</a>
            </div>
        </div>
    </body>
</html>
