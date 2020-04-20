<!DOCTYPE html>
<html>
<head>
	<title>Gestion des items</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<?php require_once('layout/dependencies.php')?>
	<link rel="stylesheet" type="text/css" href="Admin_page_gestions.css">
</head>
<body>
<?php require_once('layout/header.php');  session_abort();?>
	<?php require_once("gestion.php")?>
	<header class="page-header header container"> 
		<div class="description" > <br><br>
		<?php 
		session_start(); if(isset($_SESSION['id_admin'])){?>
        <a href = "Admin_page_gestions.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a></body><?php } ?>
			<h1><strong><center>Que voulez-vous faire ?</center></strong></h1>
			<br> 
			<div style="margin: 0 auto; max-width: 330px;">
				<a href="ajoutitem.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Ajouter des items</a><br>
				<a href="suppressionitem.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Supprimer des items</a><br>
				<?php
				// si l'utilisateur connecté est un vendeur, afficher un bouton mes offres redirigent vers MesMeilleuresOffres.php
				if(isset($_SESSION["id_vendeur"]))
				{?>
					<a href="MesMeilleuresOffres.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Mes offres</a><br>					
				<?php }
				?>
			</div>
		</div>
</html>