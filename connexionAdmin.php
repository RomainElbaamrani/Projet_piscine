<?php  

session_start();


//récuperer les données venant de la page HTML (identifiant et mot de passe)
$identifiant = isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$password = isset($_POST["mdp"])? $_POST["mdp"] : "";

$erreur = "";

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

if($erreur =="")
{
	if($db_found)
	{
		//querry
		$sql = "SELECT * FROM `admin` ";
		if($identifiant != "")
		{
			// on cherche l'admin avec les paramètres mail et password
			$sql .= "WHERE Email_admin LIKE '$identifiant' ";
			if($password != "")
			{
				$sql .= " AND Password_admin LIKE '$password'";
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
            //ouvrir la page gestion pour admin
			$_SESSION["id_admin"] = $data["idAdmin"];
			header('Location: Admin_page_gestions.php');
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

// fermer la connexion
mysqli_close($db_handle);

?>

<head>
    <title>Page d'inscription pour un administrateur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once('layout/dependencies.php')?>
    <link rel="stylesheet" type="text/css" href="page2administrateur.css">
</head>
<body>
<?php $deco = true;
 		require_once('layout/header.php')?>
        <div class="container features" style="height: 647px; padding-top: 200px; padding-left: 150px;"> 
            <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 900px;">
				<a href = "javascript:history.back()" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a><br>
            <table>
                <h2>Connexion</h2>
                <br>
                    <tr><td><input type="text" style="width: 400px;" placeholder="e-mail:" name="identifiant" class="form-control"></td>
                </tr>
                <tr><td><p></p></td></tr>
                    <tr><td><input type="password" style="width: 400px;" placeholder="Mot de passe:" name="mdp" class="form-control"></td></tr>
                    <tr><td><p></p></td></tr>
                <tr>
                    
				<td colspan="2"><input  type="submit" style="background-color: #0F056B; width: 400px; color: white;" name="connexion" value="Se connecter" class="btn btn-secondary btn-block"></td></tr>
                </table>
                <br>
        </form> 
		<?php if ($erreur !="") { echo '<div class="alert alert-danger" role="alert"> Erreur: ' . $erreur . ' </div>'; }?>
        </div>
    </div>
</div>
    <footer style='	background-color: dimgray;'class="page-footer" style="width: 100%" > 
            <div class="footer-copyright text-center" style="color: aliceblue">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr
            </div> 
        </footer>
</body>
</html>