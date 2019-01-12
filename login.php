<?php

	require_once("./include/authenticator.php");

	$status = "";
	
	if(isset($_POST['login'])){
		$auth = new Authenticator();
		$status = $auth->CheckMember($_POST['username'], $_POST['password']);
		if($status == "correct"){
			header("Location: ./memberarea/");
		}
		
	}
	
?>
<!DOCTYPE html>
<html>
    <head>
		<title>Ecoplus2 - Bisnis Masa Depan</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="investasi,saham,hotel,perhotelan,modal,duit,bisnis,peluang,usaha,mandiri"/>
        <meta name="description" content="UKM Hotel - Anda bisa sehat sekaligus pemilik hotel"/>
		<script type="text/javascript" src="jquery-1.4.2.js"></script>
		<link rel="stylesheet" href="asset/style.css" type="text/css"/>
		<link href="facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<script src="facebox.js" type="text/javascript"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('a[rel*=facebox]').facebox({
                loadingImage : 'loading.gif',
                closeImage   : 'closelabel.png'
              })
            })
		</script>        
    </head>
    <body background="images/bg_all.jpg">
        <div id="marker">
            <div id="kontainer">
                <div id="header"></div>
                <?php include("include/navigation.php") ?>
                <div id="konten" align="center">
					<p>&nbsp;
						<form method="POST" action="login.php">
							<table border=0 cellpadding='0' align="center" width=400 height=270 background="images/backlogin.png">
								<tr>
									<td>
										<table align="center">
											<tr>
												<td align="left" colspan='2'><font size=2 color="#FFFFFF"></font><?php echo $status; ?></td>
											</tr>
											<tr>
												<td align="right" width="40%"><font size=2 color="#FFFFFF">MEMBER ID</td>
												<td> : <INPUT TYPE="text" name="username" size="7"></td>
											</tr>
											<tr>
												<td></td>
											</tr>
											<tr>
												<td align="right" width="40%"><font size=2 color="#FFFFFF">PASSWORD</td>
												<td> : 
													<INPUT TYPE="password" name="password" size="7">
													<INPUT TYPE="hidden" name="login" value="YES">
												</td>
											</tr>
											<tr>
												<td align="center" colspan="2"><input type="image" src="images/login.png" name="submit" border="0"></td>
											</tr>
											<tr>
												<td></td>
											</tr>
										</table>
									</td>
								</tr>
							</table> 
						</form>            
					</p>
                </div>
                <div id="footer">
					Copyright &COPY; 2017-<?php echo date("Y") ?> - Ecoplus2<br><?php echo "http://$_SERVER[HTTP_HOST]/";?>
				</div>
            </div>
        </div>
    </body>
</html>
