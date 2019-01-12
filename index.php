<!DOCTYPE html>
<?php
	global $name;
	if(isset($_GET['id'])){
		require_once("include/check.php");
		$check = new Checker();
		$member = $check->GetMemberName($_GET['id']);
	}
?>
<html lang="id">
    <head>
		<title>Ecoplus2 - Bisnis Masa Depan</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="investasi,saham,hotel,perhotelan,modal,duit,bisnis,peluang,usaha,mandiri"/>
        <meta name="description" content="UKM Hotel - Anda bisa sehat sekaligus menjadi pemilik hotel"/>
		<script type="text/javascript" src="jquery-1.4.2.js"></script>
		<link type="text/css" rel="stylesheet" href="asset/style.css"/>
		<link type="text/css" rel="stylesheet" href="facebox.css" media="screen"/>
		<script type="text/javascript" src="facebox.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				
            });
		</script>        
		
    </head>
    <body style="background-repeat:repeat">
        <div id="marker">
            <div id="kontainer">
                <div id="header"></div>
				<?php include("include/navigation.php") ?>
                <div id="konten" align="center">
					<style type="text/css">
						div.referer {
							width: 500px;
							border: 3px solid white;
							box-shadow: 0 0 7px #000;
							margin-bottom: 10px;
							border-radius: 5px;
						}
					</style>
					<?php
					if(isset($_GET['id'])){
						echo "
						<div class='referer'>
							<p>Diperkenalkan oleh: ".$member['nama_lengkap']." (".$_GET['id'].")</p>";
						if($_GET['id'] == 'U000019'){
							echo "<p>Hubungi segera kontak HP - ".$member['handphone'].".</p>";
							echo "
							<script>
								var meta = document.getElementsByTagName('meta');
								for (var i = 0; i < meta.length; i++) {
									if (meta[i].name.toLowerCase() == 'description') {
										meta[i].content = 'Diperkenalkan oleh: ".$_GET['id']." - ".$member['nama_lengkap']." (".$member['handphone'].")';
									}
								}
							</script>
							";
						}else{
							echo"<p>Hubungi segera kontak HP YBS.</p>";
						}
						echo "</div>";
					}
					?>
					<img src="images/new-year-2019.jpg" width="500">
					<img src="images/Reward-Merdeka.jpg" width="500">
					<img src="images/produk-ecoplus2.jpg" width="500">
					<img src="images/Pencapaian-Pak-Madzaini.jpg" width="500" style="border-color: #00a551;">
					<img src="images/pengumuman-manajemen-ecoplus2.jpg" width="500">
					<img src="images/UKM.jpg" width="500">
					<img src="images/ecoplan7.png" width="500">
				</div>
                <div id="footer">
					Copyright &COPY; 2017-<?php echo date("Y") ?> - Ecoplus2<br><?php echo "http://$_SERVER[HTTP_HOST]/";?>
				</div>
            </div>
        </div>
    </body>
</html>
