<?php
session_start();
	$nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
    $mdp1 = isset($_POST["mdp1"])? $_POST["mdp1"] : "";
    $mdp2 = isset($_POST["mdp2"])? $_POST["mdp2"] : "";
    $photoprofil = isset($_POST["photoprofil"])? $_POST["photoprofil"] : "";
    $email = isset($_POST["email"])? $_POST["email"] : "";
    //$photoprofil = isset($_FILES['photoprofil']);
    $choix = isset($_POST["choix"])? $_POST["choix"] : "";

	$erreur = "";

	$database = "ebay_ece";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    
        if ($nom == ""){
		$erreur .= "Le champ Nom est vide.<br>";
	    }
	    if ($pseudo == ""){
		$erreur .= "Le champ Pseudo est vide.<br>";
    	}
    	if ($mdp1 == ""){
    	$erreur .= "Le premier champ Mot de passe est vide.<br>";
    	}
    	if ($mdp2 == ""){
		$erreur .= "Le deuxieme champ Mot de passe est vide.<br>";
    	}
    	if ($photoprofil == ""){
		$erreur .= "Le champ Photo de profil est vide.<br>";
        }
        if ($email == ""){
            $erreur .= "Le champ emailest vide.<br>";
            }
        // if ($photoprofil['size'] == 0 && $photoprofil['error'] == 0)
        // {
        //     $erreur .= "Le champ Photo de profil est vide.<br>";
        // }
        
    	if ($choix == ""){
		$erreur .= "Vous n'avez pas fait de choix.<br>";
    	}
    	if ($mdp2 != $mdp1 ){
		$erreur .= "Les mots de passe sont différents.<br>";
        }
        
        if ($erreur =="")
        {
    
            if ($db_found) 
            {
                $sql = "SELECT * FROM vendeur";
                if($nom != "") 
                {
                    //on cherche le vendeur avec les paramètres nom, pseudo et password
                    $sql .= " WHERE Nom_vendeur LIKE '%$nom%'";
                    if ($pseudo != "") 
                    {
                        $sql .= " AND Pseudo_vendeur LIKE '%$pseudo%'";
                        if($mdp1 !="")
                        {
                            $sql .= " AND Password_vendeur Like '$mdp1'";
                        }
                    }
                }
                $result = mysqli_query($db_handle, $sql);
                //regarder s'il y a des résultats
                if (mysqli_num_rows($result) != 0) 
                {
                    //le vendeur est déjà dans la BDD
                    echo "Le vendeur existe déjà !";
                } 
                else 
                {
                    $pseudo = strtolower($pseudo);

                    $sql= "INSERT INTO `vendeur`(`Nom_vendeur`, `Password_vendeur`, `Photo_vendeur`, `image_de_fond_vendeur`, `Pseudo_vendeur`, `Email_vendeur`) VALUES ('$nom','$mdp1','$photoprofil','$choix','$pseudo','$email') ";
                    $result = mysqli_query($db_handle, $sql);
                    echo "Add successful." . "<br>";
                    //on affiche le vendeur ajouté
                    $sql = "SELECT * FROM vendeur";
                    if ($nom != "") 
                    {
                        //on cherche le vendeur avec les paramètres nom, pseudo et password
                        $sql .= " WHERE Nom_vendeur LIKE '%$nom%'";
                        if ($pseudo != "") 
                        {
                            $sql .= " AND Pseudo_vendeur LIKE '%$pseudo%'";
                            if($mdp1 != "")
                            {
                                $sql .= " AND Password_vendeur LIKE '$mdp1'";
                            }
                        }
                    }
                    $result = mysqli_query($db_handle, $sql);
                    while ($data = mysqli_fetch_assoc($result)) 
                    {
                        echo "Informations sur le vendeur ajouté:" . "<br>";
                        echo "Nom: " . $data['Nom_vendeur'] . "<br>";
                        echo "Pseudo: " . $data['Pseudo_vendeur'] . "<br>";
                        echo "Photo de profil: " . $data['Photo_vendeur'] . "<br>";
                        echo "Image de fond: " . $data['image_de_fond_vendeur'] . "<br>";
                        echo "<br>";
                        // si connecté en temps qu'admin
                        if(isset($_SESSION["id_admin"]))
                        {
                            // rediriger vers la page admin
                            header('Location: Admin_page_vendeur.php');
                        }
                        // sinon
                        else
                        {
                            //rediriger vers la page de connexion de vendeur
                            header('Location: connexionVendeur.php');
                        }
                    }
                }
            } 
            else 
            {
                echo "Database not found";
            }
        }  
    
?>

<head>
	<title>Page d'inscription pour un vendeur</title>
	<?php require_once('layout/dependencies.php')?>

	<link rel="stylesheet" type="text/css" href="pageinscriptionvendeur.css">
</head>
<body>
<?php $deco = true; 
require_once('layout/header.php')?>
    <div class="container features" style="height: 800px; padding-top: 100px; padding-left: 150px;"> 
    <a href = "javascript:history.back()" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>

	    <div class="row"> 
        	<div class="col-lg-4 col-md-4 col-sm-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 500px;">
                	<table>
                        <h2>Coordonnées</h2>
                        <br>
                        <tr>
                        <td><b>Nom: </b></td></tr>
                        <tr><td><p></p></td></tr>
                        <tr><td><input type="text" style="width: 400px;" class="form-control" name="nom"></td></tr>
                        <tr><td><p></p></td></tr>
                        <tr><td><b>Pseudo: </b></td></tr>
                        <tr><td><p></p></td></tr>
        		    	<tr><td><input type="text" style="width: 400px;" class="form-control" name="pseudo"></td></tr>
                        <tr><td><p></p></td></tr>
                        <tr><td><b>Mot de passe: </b></td></tr>
                        <tr><td><p></p></td></tr>
                        <tr><td><input type="password" style="width: 400px;" class="form-control" name="mdp1"></td></tr>
                <tr><td><p></p></td></tr>
                <tr>
                    <td><b>Retaper votre mot de passe: </b></td></tr>
                    <tr><td><p></p></td></tr>
                    <tr><td><input type="password" style="width: 400px;" class="form-control" name="mdp2"></td>
                </tr>
                <tr><td><p></p></td></tr>
                <tr>
                    <td><b>Photo de profil: </b></td></tr>
                    <tr><td><p></p></td></tr>
                    <tr><td><input type="text" style="width: 400px;" class="form-control" name="photoprofil"/></td>
                </tr>
                <tr><td><p></p></td></tr>
                <tr><td><p></p></td></tr>
                <tr>
                    <td><b>E mail: </b></td></tr>
                    <tr><td><p></p></td></tr>
                    <tr><td><input type="email" style="width: 400px;" class="form-control" name="email"/></td>
                </tr>
                </table>
                <table style="width:1200px;">
                <tr>
        			<td><b>Image de fond: </b></td></tr>
                    <tr><td><p></p></td></tr>
        			<tr><td><input  style="float:left;margin-top: 10px;"type="radio"  name="choix" value="gris"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#808080;"></div>
                    <input  style="float:left;margin-top: 10px; margin-left:15px;"type="radio" name="choix" value="blanc"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:white;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="rose"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#FFC0CB;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="violet"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#EE82EE;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="rouge"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#FF0000;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="orange"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#FFA500;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="jaune"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#FFFF00;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="vert"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#008000;"></div>
                    <input  style="float:left;margin-top: 10px;margin-left:15px;"type="radio" name="choix" value="bleu"><div class="col-sm-2" style="margin-left:15px;float:left;height:50px; width:90px;background-color:#0000FF;"></div></td></tr>
                </table>
                <br>
                <table style="background: #0F056B; color:white;">
            	<tr>
                <td colspan="2"><input type="submit"  value="Valider" name="inscription" class="btn btn-secondary btn-block" style="background: #0F056B"></td></tr>
                <?php if ($erreur !="") { echo '<div class="alert alert-danger" role="alert"> Erreur: ' . $erreur . ' </div>'; }?>
            </table>
        </div>
        </div>
        </div>
        </form> 
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<footer class="page-footer" style="width: 100%" > 
			<div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr
			</div> 
		</footer>
</body>
</html>