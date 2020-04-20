<?php  

session_start();

//récuperer les données venant de la page HTML
$identifiant = isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$identifiant = strtolower($identifiant);
$password = isset($_POST["mdp"])? $_POST["mdp"] : "";

$erreur ="";


$database = "ebay_ece";

//connectez-vous dans BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($identifiant == ""){
	$erreur .= "Le champ identifiant est vide.<br>";
}
if ($password == ""){
	$erreur .= "le champ mot de passe est vide.<br>";
}

//si le button 'connexion' est cliqué
if (isset($_POST['connexion'])) 
{
	if($erreur =="")
	{
		if($db_found)
		{
			//querry
			$sql = "SELECT * FROM vendeur";
			if($identifiant != "")
			{
				// on cherche le vendeur avec les paramètres pseudo et mot de passe
				$sql .= " WHERE Pseudo_vendeur LIKE '$identifiant'";
				if($password != "")
				{
					$sql .= " AND Password_vendeur LIKE '$password'";
				} 
			}
			$result = mysqli_query($db_handle, $sql);
			//regarder s'il y a des résultats
			if(mysqli_num_rows($result) == 0)
			{
				// reouvrir la page page2acheteur
				echo "connexion échoué";
			}
			else
			{
				$data = mysqli_fetch_assoc($result);
				//ouvrir la page html interface acheteur
				echo "Connexion reussite";
				$_SESSION["id_vendeur"] = $data["idVendeur"];
				header('Location: Admin_gestion_items.php');

			}
		}
		else
		{
			//BDD n'existe pas 
			echo "Database not found";

		}
	}
	else
	{
		echo "Erreur: $erreur";
	}
}
else if (isset($_POST['inscription'])) 
{
    // ouvrir la page connexion vendeur
	echo "page d'inscription veudeur";
	header('Location: pageinscriptionvendeur.php');
}

// fermer la connexion

mysqli_close($db_handle);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Page de connexion pour un vendeur</title>
	<meta charset="utf-8">
	<?php require_once('layout/dependencies.php')?>
	<link rel="stylesheet" type="text/css" href="page2acheteur.css">
</head>
<body>
<?php $deco = true;
require_once('layout/header.php')?>
		<div class="container features" style="height: 618px; padding-top: 180px; padding-left: 150px;"> 
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<a href = "javascript:history.back()" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>
<br>
			<div class="row"> 
				<div class="col-lg-4 col-md-4 col-sm-12"> 
					<h3 class="feature-title">Connexion</h3> 
					 <div class="form-group"> <input type="text" class="form-control" placeholder="Pseudo:" name="identifiant"> 
					</div> 
					<div class="form-group"> <input type="password" class="form-control" placeholder="Mot de passe:" name="mdp">
					</div>
					<div>
					<input type="submit" class="btn btn-secondary btn-block" value="Se connecter" name="connexion" style="background: #0F056B;"> 
				</div>
				</div>
				<div class="inscription" style="padding-left: 50px; padding-top: 110px; width: 500px;" > 
				<input type="submit" class="btn btn-secondary btn-block" value="Inscription" name="inscription" style="background: #0F056B"> 
				<?php if ($erreur !="") { echo '<div class="alert alert-danger" role="alert"> Erreur: ' . $erreur . ' </div>'; }?>
			</div> 
		</form>
		</div>
	</div>
	<footer style='	background-color: dimgray;'class="page-footer" style="width: 100%" > 
			<div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr
			</div> 
		</footer>
</body>
</html>