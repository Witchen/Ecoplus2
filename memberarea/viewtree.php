<?php
session_start();
if($_SESSION['member'] == null){
	header("Location: ./../");
	exit();
}

require_once("./include/viewtreehandler.php");
$handler = new ViewTreeHandler();
if(!isset($_GET['topid'])){
	$memberlist = $handler->GetMemberChart($_SESSION['member']['id']);
}else{
	$memberlist = $handler->GetMemberChart($_GET['topid']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Selamat Datang Di Member Area - Ecoplus Priority</title>
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
				<form method='POST' action='viewtree.php'>
					<table width='100%'>
						<tr align='center'>
							<td colspan=4 >
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[0]['id'];?>'><?php echo $memberlist[0]['id'];?></a></td>
									</tr>
									<tr align='center' bgcolor='#FFFFFF'>
										<td colspan='2'><font size='2'><?php echo $memberlist[0]['nama_lengkap'];?><br><?php echo $memberlist[0]['tanggal_aktif'];?></td>
									</tr>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[0]['volume_kiri'];?></td>
										<td><?php echo $memberlist[0]['volume_kanan'];?></td>
									</tr>
								</table>
									</td>
						</tr>
						<tr align='center'>
							<td colspan=4><img src='images/bignet.jpg'></td>
						</tr>
						<tr>
							<!-- Member1 -->
							<td width='50%' colspan=2  align='center'>
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[1]['id'];?>'><?php echo $memberlist[1]['id'];?></a></td>
									</tr>
									<?php
	
										if($memberlist[1] != null){
											echo "
											<tr align='center' bgcolor='#FFFFFF'>
												<td colspan='2'><font size='2'>".$memberlist[1]['nama_lengkap']."<br>".$memberlist[1]['tanggal_aktif']."</td>
											</tr>
											";
										}else{
											if($memberlist[0] != null){
												echo "
												<tr align='center'>
													<td colspan='2'><font size='2'><a href='registrasi.php?sp=".$_SESSION['member']['id']."&up=".$memberlist[0]['id']."&posisi=kiri'>INPUT MEMBER BARU</a></td>
												</tr>
												";
											}else{
												echo "
												<tr align='center' bgcolor='#FFFFFF'>
													<td colspan='2'><font size='2'>KOSONG</td>
												</tr>
												";
											}
										}
									?>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[1]['volume_kiri']; ?></td>
										<td><?php echo $memberlist[1]['volume_kanan']; ?></td>
									</tr>
								</table>
							</td>
							<!-- Member2 -->
							<td colspan=2  align='center'>
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[2]['id'];?>'><?php echo $memberlist[2]['id'];?></a></td>
									</tr>
									<?php
										if($memberlist[2] != null){
											echo "
											<tr align='center' bgcolor='#FFFFFF'>
												<td colspan='2'><font size='2'>".$memberlist[2]['nama_lengkap']."<br>".$memberlist[2]['tanggal_aktif']."</td>
											</tr>
											";
										}else{
											if($memberlist[0] != null){
												echo "
												<tr align='center'>
													<td colspan='2'><font size='2'><a href='registrasi.php?sp=".$_SESSION['member']['id']."&up=".$memberlist[0]['id']."&posisi=kanan'>INPUT MEMBER BARU</a></td>
												</tr>
												";
											}else{
												echo "
												<tr align='center' bgcolor='#FFFFFF'>
													<td colspan='2'><font size='2'>KOSONG</td>
												</tr>
												";
											}
										}
									?>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[2]['volume_kiri']; ?></td>
										<td><?php echo $memberlist[2]['volume_kanan']; ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr align='center'>
							<td colspan=2><img src='images/littlenet.jpg'></td>
							<td colspan=2><img src='images/littlenet.jpg'></td>
						</tr>
						<tr bgcolor='#00FF00'>
							<!-- Member3 -->
							<td width='25%' align='center'>
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[3]['id'];?>'><?php echo $memberlist[3]['id'];?></a></td>
									</tr>
									<?php
										if($memberlist[3] != null){
											echo "
											<tr align='center' bgcolor='#FFFFFF'>
												<td colspan='2'><font size='2'>".$memberlist[3]['nama_lengkap']."<br>".$memberlist[3]['tanggal_aktif']."</td>
											</tr>
											";
										}else{
											if($memberlist[1] != null){
												echo "
												<tr align='center'>
													<td colspan='2'><font size='2'><a href='registrasi.php?sp=".$_SESSION['member']['id']."&up=".$memberlist[1]['id']."&posisi=kiri'>INPUT MEMBER BARU</a></td>
												</tr>
												";
											}else{
												echo "
												<tr align='center' bgcolor='#FFFFFF'>
													<td colspan='2'><font size='2'>KOSONG</td>
												</tr>
												";
											}
										}
									?>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[3]['volume_kiri']; ?></td>
										<td><?php echo $memberlist[3]['volume_kanan']; ?></td>
									</tr>
								</table>
								<br>
								<?php
									if($memberlist[3] != null){
										echo "
										<a href='http://".$_SERVER['HTTP_HOST']."/memberarea/viewtree.php?topid=".$memberlist[3]['id']."'>View</a>
										";
									}
								?>
							</td>
							<!-- Member4 -->
							<td width='25%' align='center'>
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[4]['id'];?>'><?php echo $memberlist[4]['id'];?></a></td>
									</tr>
									<?php
										if($memberlist[4] != null){
											echo "
											<tr align='center' bgcolor='#FFFFFF'>
												<td colspan='2'><font size='2'>".$memberlist[4]['nama_lengkap']."<br>".$memberlist[4]['tanggal_aktif']."</td>
											</tr>
											";
										}else{
											if($memberlist[1] != null){
												echo "
												<tr align='center'>
													<td colspan='2'><font size='2'><a href='registrasi.php?sp=".$_SESSION['member']['id']."&up=".$memberlist[1]['id']."&posisi=kanan'>INPUT MEMBER BARU</a></td>
												</tr>
												";
											}else{
												echo "
												<tr align='center' bgcolor='#FFFFFF'>
													<td colspan='2'><font size='2'>KOSONG</td>
												</tr>
												";
											}
										}
									?>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[4]['volume_kiri']; ?></td>
										<td><?php echo $memberlist[4]['volume_kanan']; ?></td>
									</tr>
								</table>
								<br>
								<?php
									if($memberlist[4] != null){
										echo "
										<a href='http://".$_SERVER['HTTP_HOST']."/memberarea/viewtree.php?topid=".$memberlist[4]['id']."'>View</a>
										";
									}
								?>
							</td>
							<!-- Member5 -->
							<td width='25%' align='center'>
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[5]['id'];?>'><?php echo $memberlist[5]['id'];?></a></td>
									</tr>
									<?php
										if($memberlist[5] != null){
											echo "
											<tr align='center' bgcolor='#FFFFFF'>
												<td colspan='2'><font size='2'>".$memberlist[5]['nama_lengkap']."<br>".$memberlist[5]['tanggal_aktif']."</td>
											</tr>
											";
										}else{
											if($memberlist[2] != null){
												echo "
												<tr align='center'>
													<td colspan='2'><font size='2'><a href='registrasi.php?sp=".$_SESSION['member']['id']."&up=".$memberlist[2]['id']."&posisi=kiri'>INPUT MEMBER BARU</a></td>
												</tr>
												";
											}else{
												echo "
												<tr align='center' bgcolor='#FFFFFF'>
													<td colspan='2'><font size='2'>KOSONG</td>
												</tr>
												";
											}
										}
									?>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[5]['volume_kiri']; ?></td>
										<td><?php echo $memberlist[5]['volume_kanan']; ?></td>
									</tr>
								</table>
								<br>
								<?php
									if($memberlist[5] != null){
										echo "
										<a href='http://".$_SERVER['HTTP_HOST']."/memberarea/viewtree.php?topid=".$memberlist[5]['id']."'>View</a>
										";
									}
								?>
							</td>
							<!-- Member6 -->
							<td width='25%' align='center'>
								<table align='center' width='125' style="font-family: Arial; color: #0000FF; font-size: 8pt; font-weight: bold; border: 1px solid #00FF00; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background-color: #00ff00" height='135'>
									<tr align='center'>
										<td colspan='2'><font size='2'><a href='<?php echo "http://$_SERVER[HTTP_HOST]"; ?>/memberarea/viewtree.php?topid=<?php echo $memberlist[6]['id'];?>'><?php echo $memberlist[6]['id'];?></a></td>
									</tr>
									<?php
										if($memberlist[6] != null){
											echo "
											<tr align='center' bgcolor='#FFFFFF'>
												<td colspan='2'><font size='2'>".$memberlist[6]['nama_lengkap']."<br>".$memberlist[6]['tanggal_aktif']."</td>
											</tr>
											";
										}else{
											if($memberlist[2] != null){
												echo "
												<tr align='center'>
													<td colspan='2'><font size='2'><a href='registrasi.php?sp=".$_SESSION['member']['id']."&up=".$memberlist[2]['id']."&posisi=kanan'>INPUT MEMBER BARU</a></td>
												</tr>
												";
											}else{
												echo "
												<tr align='center' bgcolor='#FFFFFF'>
													<td colspan='2'><font size='2'>KOSONG</td>
												</tr>
												";
											}
										}
									?>
									<tr align='center' bgcolor='#FFFFFF'>
										<td><?php echo $memberlist[6]['volume_kiri']; ?></td>
										<td><?php echo $memberlist[6]['volume_kanan']; ?></td>
									</tr>
								</table>
								<br>
								<?php
									if($memberlist[6] != null){
										echo "
										<a href='http://".$_SERVER['HTTP_HOST']."/memberarea/viewtree.php?topid=".$memberlist[6]['id']."'>View</a>
										";
									}
								?>
							</td>
						</tr>
					</table>
				</form>
                </div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                Copyright &COPY; 2017-<?php echo date("Y") ?> - <a href=<?php echo "http://$_SERVER[HTTP_HOST]/";?>>UKM Hotel</a>
            </div>
        </div>
    </body>
</html>
