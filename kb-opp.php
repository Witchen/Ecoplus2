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
    </head>
    <body style="background-repeat:repeat">
        <div id="marker">
            <div id="kontainer">
                <div id="header"></div>
				<?php include("include/navigation.php") ?>
                <div id="konten" align="center">
				</div>
                <div id="footer">
					Copyright &COPY; 2017-<?php echo date("Y") ?> - Ecoplus2<br><?php echo "http://$_SERVER[HTTP_HOST]/";?>
				</div>
            </div>
        </div>
    </body>
</html>
