<?php
	$nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $adresse1 = isset($_POST["adresse1"])? $_POST["adresse1"] : "";
    $adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"] : "";
    $ville = isset($_POST["ville"])? $_POST["ville"] : "";
    $codepostal = isset($_POST["codepostal"])? $_POST["codepostal"] : "";
    $pays = isset($_POST["pays"])? $_POST["pays"] : "";
    $telephone = isset($_POST["telephone"])? $_POST["telephone"] : "";
    $email = isset($_POST["email"])? $_POST["email"] : "";
    $motdepasse1 = isset($_POST["motdepasse1"])? $_POST["motdepasse1"] : "";
    $motdepasse2 = isset($_POST["motdepasse2"])? $_POST["motdepasse2"] : "";

	$erreur = "";

	$database = "ebay_ece";
    
    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    
    // vérification du remplissage des champs demandés
	{if ($nom == ""){
		$erreur .= "Le champ Nom est vide.<br>";
	}
	if ($prenom == ""){
		$erreur .= "Le champ Prénom est vide.<br>";
	}
	if ($adresse1 == ""){
		$erreur .= "La premiere case d'adresse est vide.<br>";
	}
	if ($ville == ""){
		$erreur .= "Le champ Ville est vide.<br>";
	}
	if ($codepostal == ""){
		$erreur .= "Le champ Code Postal est vide.<br>";
	}
	if ($pays == ""){
		$erreur .= "Le champ Pays est vide.<br>";
	}
	if ($telephone == ""){
		$erreur .= "Le champ Telephone est vide.<br>";
	}
	if ($email == ""){
		$erreur .= "Le champ Email est vide.<br>";
	}
	if ($motdepasse1 == ""){
		$erreur .= "La premier mot de passe est vide.<br>";
	}
	if ($motdepasse2 == ""){
		$erreur .= "Le deuxieme mot de passe est vide.<br>";
	}
	if ($motdepasse2 != $motdepasse1 ){
		$erreur .= "Les mots de passe sont différents.<br>";
	}
	}

	if ($erreur =="")
	{

		if ($db_found) 
        {
            $sql = "SELECT * FROM client";
            if($nom != "") 
            {
                //on cherche le client avec les paramètres nom, premon et password
                $sql .= " WHERE Nom_client LIKE '$nom'";
                if ($prenom != "") 
                {
					$sql .= " AND Prenom_client LIKE '$prenom'";
					if($motdepasse1 !="")
					{
						$sql .= " AND Password_client Like '$motdepasse1'";
					}
                }
            }
            $result = mysqli_query($db_handle, $sql);
            //regarder s'il y a de résultat
            if (mysqli_num_rows($result) != 0) 
            {
                //le client est déjà dans la BDD
                echo "Le client existe déjà !";
            } 
            else 
            {
                
                $sql= "INSERT INTO `client`(`Nom_client`, `Prenom_client`, `Password_client`, `Adresse_client`, `Email_client`, `Ville_client`, `Code_postal_client`, `Tel_client`) VALUES ('$nom','$prenom','$motdepasse1','$adresse1','$email','$ville','$codepostal','$telephone') ";
                $result = mysqli_query($db_handle, $sql);
                //echo "Add successful." . "<br>";
                //on affiche le livre ajouté
				$sql = "SELECT * FROM client";
				if ($nom != "") 
                {
                    //on cherche le client avec les paramètres nom, prenom et password
                    $sql .= " WHERE Nom_client LIKE '%$nom%'";
                    if ($prenom != "") 
                    {
						$sql .= " AND Prenom_client LIKE '%$prenom%'";
						if($motdepasse1 != "")
						{
							$sql .= " AND Password_client LIKE '$motdepasse1'";
						}
                    }
                }
                $result = mysqli_query($db_handle, $sql);
                while ($data = mysqli_fetch_assoc($result)) 
                {
                    // afficher les informations du client ajouté
                    echo "Informations sur le client ajoutées:" . "<br>";
                    echo "Nom: " . $data['Nom_client'] . "<br>";
                    echo "Prenom: " . $data['Prenom_client'] . "<br>";
                    echo "E mail: " . $data['Email_client'] . "<br>";
                    echo "Tel: " . $data['Tel_client'] . "<br>";
                    echo "<br>";
                    header('Location: connexionAcheteur.php');

				}
				//echo "Les données ont été enregistrées.";

		    }

        } 
        else 
        {
            echo "Database not found";
        }

		
	} 
?>

<head>
	<title>Page d'inscription pour un acheteur</title>
    <?php $deco = true; 
    require_once('layout/dependencies.php')?>

	<link rel="stylesheet" type="text/css" href="pageinscriptionacheteur.css">
</head>
<body>
<?php require_once('layout/header.php')?>


		<div class="container features" style="height: 1100px; padding-top: 100px; padding-left: 150px;"> 
        <a href = "javascript:history.back()" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>

        <div class="row"> 
				<div class="col-lg-4 col-md-4 col-sm-12">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 500px;">
        	<table>
                <h2>Coordonnées</h2>
                <br>
                <tr>
        			<td><b>Nom: </b></td></tr>
        			<tr><td><input type="text" style="width: 400px;" class="form-control" name="nom"></td>
        		</tr>
                <tr>
                    <td><b>Prénom: </b></td></tr>
                    <tr><td><input type="text" style="width: 400px;"class="form-control" name="prenom"></td>
                </tr>
                <tr>
        			<td><b>Adresse: </b></td></tr>
        			<tr><td><input type="text" style="width: 400px;"class="form-control" name="adresse1"></td>
        		</tr>
        		<tr><td><input type="text" style="width: 400px;" class="form-control" name="adresse2"></td>
        		</tr>
                <tr>
                    <td><b>Ville: </b></td></tr>
                    <tr><td><input type="text" style="width: 400px;"class="form-control" name="ville"></td>
                </tr>
                <tr>
        			<td><b>Code Postal: </b></td></tr>
        			<tr><td><input type="number" style="width: 400px;" class="form-control"name="codepostal"></td>
        		</tr>
                <tr>
                    <td><b>Pays: </b></td></tr>
                    <tr><td><input type="text" style="width: 400px;" class="form-control" name="pays"></td>
                </tr>
                <tr>
                    <td><b>Téléphone: </b></td></tr>
                    <tr><td><input type="tel" style="width: 400px;" class="form-control" name="telephone"></td>
                </tr>
                <tr>
        			<td><b>Email: </b></td></tr>
        			<tr><td><input type="email" style="width: 400px;" class="form-control" name="email"></td>
        		</tr>
                <tr>
                    <td><b>Mot de passe: </b></td></tr>
                    <tr><td><input type="password" style="width: 400px;" class="form-control" name="motdepasse1"></td>
                </tr>
                <tr>
                    <td><b>Retaper votre mot de passe: </b></td></tr>
                    <tr><td><input type="password" style="width: 400px;" class="form-control" name="motdepasse2"></td>
                </tr>
                </table>
                <br>
                <p>Nous vous enverrons régulièrement des e-mails avec des offres concernant nos services. Vous pouvez vous désinscrire de ces e-mails marketing en tout temps, sans frais, via Mon eBay ECE ou en cliquant sur le lien inclus dans les e-mails.</p>

     <p><input type="checkbox" name="domaine" value="documentation">
     En cochant la case, vous confirmez avoir lu et accepté les Conditions d'utilisation. Veuillez vous référer à notre Avis sur les données personnelles pour toute information concernant le traitement de vos données.</p>
            <table style="background: #0F056B; color:white;">
            	<tr>
                <td colspan="2"> 
                    <input type="submit" class="btn btn-primary" value="Valider">
                </td>
            </tr>
                <?php if ($erreur !="") { echo '<div class="alert alert-danger" role="alert"> Erreur: ' . $erreur . ' </div>'; }?>
            </table>
        </form> 
							
		</div>
	
	</div>
</div>
    <footer class="page-footer" style="width: 100%" > <br><br><br><br><br><br><br><br><br><br><br><br>rb
    
			<div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr
			</div> 
		</footer>
</body>
</html>