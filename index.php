<!DOCTYPE html>
<html>
<head>
	<title>Ebay ECE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<?php require_once('layout/dependencies.php')?>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
		<div class="container"> <br><br>
			<h1 style="text-align: center; color:aliceblue;">Bienvenue sur Ebay ECE!</h1>
			<br>
			<div id="Logo" style="text-align: center;"><img src="Logo.jpg"></div>
			<br>
			<div style="margin: 0 auto; max-width: 330px;">
				<a href="connexionAdmin.php" class="btn btn-outline-light btn-block btn-lg" style=" margin: 5px 0">Administrateur</a><br>
				<a href="connexionAcheteur.php" class="btn btn-outline-light btn-block btn-lg" style=" margin: 5px 0">Acheteur</a><br>
				<a href="connexionVendeur.php" class="btn btn-outline-light btn-block btn-lg" style=" margin: 5px 0">Vendeur</a>
			</div>
		</div>
</body>
</html>