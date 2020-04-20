<?php

    //récupérer la session active 
    session_start();

	$nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $photo1 = isset($_POST["photo1"])? $_POST["photo1"] : "";
    $photo2 = isset($_POST["photo2"])? $_POST["photo2"] : "";
    $photo3 = isset($_POST["photo3"])? $_POST["photo3"] : "";
    $description = isset($_POST["description"])? $_POST["description"] : "";
    $prix = isset($_POST["prix"])? $_POST["prix"] : "";
    $typedevente1 = isset($_POST["typedevente1"])? $_POST["typedevente1"] : "";
    $typedevente2 = isset($_POST["typedevente2"])? $_POST["typedevente2"] : "";
    $categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
	$logoprix = isset($_POST["logoprix"])? $_POST["logoprix"] : "";
	$dateFinVente = isset($_POST["finVente"])? $_POST["finVente"] : "";
	$video = isset($_POST["video"])? $_POST["video"] : "";

	$erreur = "";
	$database = "ebay_ece";
    
    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    
    // si le bouton submit est cliqué 
    if(isset($_POST['ajoutItem']))
    {
        // vérifier le bon remplissage des champs 
        if ($nom == ""){
            $erreur .= "Le champ Nom est vide.<br>";
        }
        if ($photo1 == ""){
            $erreur .= "Au moin une photo est necessaire.<br>";
        }
        if ($description == ""){
            $erreur .= "La personne n'a mis aucune description.<br>";
        }
        if ($prix == ""){
            $erreur .= "Le champ Prix est vide.<br>";
        }
        if (($typedevente1 == "Encheres")&&($typedevente2 == "Encheres")){
            $erreur .= "Les deux types de vente doivent être différents.<br>";
        }
        if (($typedevente1 == "Encheres")&&($typedevente2 == "Achait Immediat")){
            $erreur .= "Un item ne peut pas être une Enchère et un Achat Immédiat.<br>";
        }
        if (($typedevente1 == "Achait Immediat")&&($typedevente2 == "Encheres")){
            $erreur .= "Un item ne peut pas être une Enchère et un Achat Immédiat.<br>";
        }

        if ($erreur =="")
        {

            if ($db_found) 
            {
                $sql = "SELECT * FROM `item`";
                if($nom != "") 
                {
                    //on cherche l'item avec les paramètres nom, description et prix
                    $sql .= " WHERE Nom_item Like '$nom'";
                    if ($description != "") 
                    {
                        $sql .= "  AND Description_item LIKE '$description'";
                        if($prix !="")
                        {
                            $sql .= " AND Prix_item LIKE '$prix'";
                        }
                    }
                }
                $result = mysqli_query($db_handle, $sql);
                //regarder s'il y a de résultat
                if (mysqli_num_rows($result) != 0) 
                {
                    //l'item est déjà dans la BDD
                    echo "L'item existe déjà !";
                } 
                else 
                {
                    // si connecté en temps qu'administrateur 
                    if(isset($_SESSION["id_admin"]))
                    {
                        // ajout de l'item avec l'identifiantde de l'administrateur qui l'a ajouté
                        $id_admin = $_SESSION["id_admin"];
                        $sql= "INSERT INTO `item`(`Nom_item`, `Photo_item`, `Description_item`, `Video_item`, `Prix_item`, `date_de_fin_item`, `Type_de_vente_1`,`Type_de_vente_2`, `categorie_item`,`idAdmin`) VALUES ('$nom','$photo1','$description','$video','$prix','$dateFinVente','$typedevente1','$typedevente2','$categorie','$id_admin') ";
                    }
                    else
                    {
                        // ajout de l'item avec l'identifiantde du vendeur qui l'a ajouté
                        $id_vendeur = $_SESSION["id_vendeur"];
                        $sql= "INSERT INTO `item`(`Nom_item`, `Photo_item`, `Description_item`, `Video_item`, `Prix_item`, `date_de_fin_item`, `Type_de_vente_1`,`Type_de_vente_2`, `categorie_item`,`idVendeur`) VALUES ('$nom','$photo1','$description','$video','$prix','$dateFinVente','$typedevente1','$typedevente2','$categorie','$id_vendeur') ";                    
                    }
                    $result = mysqli_query($db_handle, $sql);
                    $succes = true;
                }
            } 
            else 
            {
                echo "Database not found";
            }
        }
        else
        {
            echo "Erreur: $erreur";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un article</title>
    <?php require_once('layout/dependencies.php')?>
    <link rel="stylesheet" type="text/css" href="ajoutitem.css">
    <?php if(isset($succes)){ echo '<script> $(document).ready(function(){         $("#exampleModal").modal("show");     });';}?> </script>
</head>
<body>
<?php require_once('layout/header.php')?>
        <div class="container features" style="height: 1200px; padding-top: 100px; padding-left: 150px;"> 
        <a href = "Admin_gestion_items.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a></body>
<br>
			<div class="row"> 
				<div class="col-lg-4 col-md-4 col-sm-12">
				<form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="width: 500px;">
                <div class="form-group">
                    <label>Nom de l'item: </label>
                    <input type="text" class="form-control" name="nom" placeholder="Enter un nom">
                </div>
                <div class="form-group">
                    <label>Photo(s):</label>
                    <input type="text" style="width: 400px;" class="form-control" placeholder="Mettre l'URL de la photo." name="photo1"> <br>
                    <input type="text" style="width: 400px;" class="form-control" placeholder="Mettre l'URL de la photo." name="photo2"> <br>
                    <input type="text" style="width: 400px;" class="form-control" placeholder="Mettre l'URL de la photo." name="photo3">
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" class="form-control" placeholder="Vous devez décrire l'item." rows=4 cols=60></textarea>
                </div>
                <div class="form-group">
                    <label>Vidéo:</label>
                    <input type="text" class="form-control" style="width: 400px;" placeholder="Mettre l'URL de la vidéo." name="video">
                </div>
                <div class="form-group">
                    <label >Catégorie: </label>
                    <select class="form-control" name="categorie">
                        <option>Ferraille ou Tresor</option>
                        <option>Bon pour le Musee</option>
                        <option>Accessoire VIP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Date de fin de vente :</label>
                    <input type="text" class="form-control" style="width: 400px;" placeholder="entrez la date de fin de disponibilité" name="finVente">
                </div>
                <div class="form-group">
                    <label>Prix: </label>
                    <input type="text" class="form-control" placeholder="Mettre le prix." name="prix">
                    <label>Devices: </label>
                    <select class="form-control" name="logoprix">
                        <option>€</option>
                        <option>$</option>
                        <option>£</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Type de vente 1: </label>
                    <select class="form-control" name="typedevente1">
                    <option>Encheres</option>
                        <option>Achat Immediat</option>
                        <option>Meilleure Offre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Type de vente 2: </label>
                    <select class="form-control" name="typedevente2">
                        <option>Encheres</option>
                        <option>Achat Immediat</option>
                        <option>Meilleure Offre</option>
                        <option>Rien</option>
                    </select>
                </div>
                    <button  type="submit" class="btn btn-primary" value="Valider" name ="ajoutItem">Submit</button>  </body>

                    <br><br>
                    <?php if ($erreur !="") { echo '<div class="alert alert-danger" role="alert"> Erreur: ' . $erreur . ' </div>'; }?>
                </div>

                
        </div>
    </div>
        </form>
        <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informations item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?php 
        if ($erreur =="")
        {
        
            echo "Nom: " . $nom . "<br>";
            echo "Description: " . $description . "<br>";
            echo "catégorie: " . $categorie . "<br>";
            echo "Type de vente 1: " . $typedevente1 . "<br>";
            echo "Type de vente 2: " . $typedevente2 . "<br>";
            echo "Prix: " . $prix . "<br>";
            echo "Date de fin: " . $dateFinVente . "<br>";
            echo "<br>";
                
        }?></p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
        <footer class="page-footer" style="width: 100%" >
        <br><br><br> <br><br><br><br>
			<div class="footer-copyright text-center">&copy; 2019 Copyright | Droit d'auteur: webDynamique.ece.fr
			</div> 
		</footer>
</body>
</html>