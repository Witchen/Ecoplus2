<!DOCTYPE html>
<?php
	
?>
<html lang="id">
    <head>
		<title>Ecoplus2 - Bisnis Masa Depan</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="investasi,saham,hotel,perhotelan,modal,duit,bisnis,peluang,usaha,mandiri"/>
        <meta name="description" content="UKM Hotel - Anda bisa sehat sekaligus pemilik hotel"/>
		<script type="text/javascript" src="jquery-1.4.2.js"></script>
		<link type="text/css" rel="stylesheet" href="asset/style.css"/>
		<link type="text/css" rel="stylesheet" href="facebox.css" media="screen"/>
		<script type="text/javascript" src="facebox.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('a[rel*=facebox]').facebox({
                loadingImage : 'loading.gif',
                closeImage   : 'closelabel.png'
              })
            })
		</script>        
    </head>
    <body>
        <div id="marker">
            <div id="kontainer">
                <div id="header"></div>
                <?php include("include/navigation.php") ?>
                <div id="konten" align="center">
					<style type="text/css">
						div.box {
							width: 480px;
							border: 3px solid white;
							box-shadow: 0 0 7px #000;
							margin-bottom: 10px;
							border-radius: 5px;
							margin-left: auto;
							margin-right: auto;
							padding: 10px;
							background-color: #062d6b;
							color: white;
						}
					</style>
					<img src="images/visimisi.jpg" width="500">
					<img src="images/legalitas.jpg" width="500">
				</div>
                <div id="footer">
					Copyright &COPY; 2017-<?php echo date("Y") ?> - Ecoplus2<br><?php echo "http://$_SERVER[HTTP_HOST]/";?>
				</div>
            </div>
        </div>
    </body>
</html>
