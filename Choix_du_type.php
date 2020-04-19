
<?php

session_start();

?>

<!-- page affichant les choix possibles pour un acheteur -->
<!DOCTYPE html>
<html>
<head>
	<title>Type de vente</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<?php require_once('layout/dependencies.php')?>
	<link rel="stylesheet" type="text/css" href="Admin_page_gestions.css">
</head>
<body>
<?php require_once('layout/header.php')?>

		<div class="container" > 
			<div class=""><br><br>

				<h1 ><strong>Quel type de vente voulez-vous choisir ?</strong></h1>
				<br> 
				<div style="margin: 0 auto; max-width: 330px;">
				<a href="Enchere.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Enchères</a><br>
				<a href="achatimmediat.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Achat immédiat</a><br>
				<a href="meilleurOffre.php" class="btn btn-outline-primary btn-block btn-lg" style=" margin: 5px 0">Meilleure offre</a><br>
			</div>
			</div>

		</div>

</body>
</html>

