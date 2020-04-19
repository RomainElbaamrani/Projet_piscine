<?php



session_start();



//echo $_SESSION["id_vendeur"];



	$typecarte = isset($_POST["typecarte"])? $_POST["typecarte"] : "";
    $numerocarte = isset($_POST["numerocarte"])? $_POST["numerocarte"] : "";
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $dateexpiration = isset($_POST["dateexpiration"])? $_POST["dateexpiration"] : "";
    $codesecurite = isset($_POST["codesecurite"])? $_POST["codesecurite"] : "";
    $prix = isset($_POST["prix"])? $_POST["prix"] : "";
    $long = strlen($codesecurite); 
	$erreur = "";

	$database = "ebay_ece";  
    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);	

	if ($nom == ""){
		$erreur .= "Le champ Nom est vide.<br>";
	}
	if ($numerocarte == ""){
		$erreur .= "Le champ Numéro de carte est vide.<br>";
	}
	if ($dateexpiration == ""){
		$erreur .= "Le champ Date d'expiration est vide.<br>";
	}
	if ($codesecurite == ""){
		$erreur .= "Le champ Code de sécurité est vide.<br>";
	}
	if ($prix == ""){
		$erreur .= "Le champ Prix est vide.<br>";
	}
	if (($long != "3")&&($long != "4")){
		$erreur .= "Le code de sécurité doit comporté 3 ou 4 chiffres.<br>";
	}
	if ($erreur ==""){
		echo "Les données ont été enregistré.";
	} else 
	{
		echo "Erreur: $erreur";
	}
?>


<html>
<head>

    <title>Page de payement</title>
	<?php require_once('layout/dependencies.php')?>


    <link rel="stylesheet" type="text/css" href="payement.css">

</head>

<body>

<?php require_once('layout/header.php')?>
        <div class="container features" style="height: 760px; padding-top: 100px; padding-left: 150px;"> 
            <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-12">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 500px;">
                    <table>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td><b>Type de carte: </b></td></tr>
                            <tr><td><p></p></td></tr>
                            <tr><td><input type="radio" name="typedecarte"> Visa 
                            <input type="radio" name="typedecarte"> MasterCard
                            <input type="radio" name="typedecarte"> American Express
                            <input type="radio" name="typedecarte"> Paypal
                        </td></tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td><b>Numéro de carte: </b></td></tr>
                            <tr><td><p></p></td></tr>
                            <tr><td><input type="number" style="width: 400px;" name="numerocarte"></textarea></td>    
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td><b>Nom affiché sur la carte: </b></td></tr>
                            <tr><td><p></p></td></tr>
                            <tr><td><input type="text" style="width: 400px;" name="nom"></td></tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td><b>Date d'expiration de la carte: </b></td></tr>
                            <tr><td><p></p></td></tr>
                            <tr><td><input type="date" style="width: 90px;" name="dateexpiration"></td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td><b>Code de sécurité</b></td></tr>
                            <tr><td><p></p></td></tr>
                            <tr><td><input type="number" style="width: 70px;" name="codesecurite"></td>
                        </tr>
                        <tr><td><p></p></td></tr>
                        <tr>
                            <td><b>Montant à payer: </b></td></tr>
                            <tr><td><p></p></td></tr>
                            <tr><td><input type="number" style="width: 70px; height: 25px;" name="prix"><select name="logoprix" size=1>
                                <option>€</option>
                                <option>$</option>
                                <option>£</option>
                                </select></td>
                        </tr>
                        <tr><td><p></p></td></tr>
                    </table>
                    <br>
                    <table style="background: #0F056B; color:white;">
                        <tr>
                        <td colspan="2"><input type="submit" style="background-color: #0F056B; width: 400px; color: white;" value="Valider mon achat"></td></tr>
                    </table>
                </div>
            </div>
        </div>
                </form> 
    <footer class="page-footer" style="width: 100%" > 
            <div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr
            </div> 
        </footer>
</body>
</html>