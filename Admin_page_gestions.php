<!DOCTYPE html>
<html>
<head>
	<title>Gestion de l'administrateur</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<?php require_once('layout/dependencies.php')?>
	<link rel="stylesheet" type="text/css" href="Admin_page_gestions.css">
</head>
<body>
<?php require_once('layout/header.php')?>
	<header class="page-header header container"> 
		<div class="description" > <br>

			<h1><strong><center>Que voulez-vous faire ?</center></strong></h1>
			<br> 
			<div style="margin: 0 auto; max-width: 330px;">
				<a href="Admin_gestion_items.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Gestion des items</a><br>
				<a href="Admin_page_vendeur.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Gestion des vendeurs</a><br>
				<a href="MesMeilleuresOffres.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Mes offres</a><br>
				<a href="Mesenchere.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Mes Enchères</a><br>
			</div>
		</div>
</body>
</html>