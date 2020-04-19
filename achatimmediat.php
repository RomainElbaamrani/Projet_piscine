<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- recuperer les scripts depuis le dossier layout/dependencies.php -->
    <?php require_once('layout/dependencies.php')?> 
    <title>Achat Immediat</title>
</head>
<body>
    <!-- recuperer le header dynamic depuis le dossier layout/header.php -->
    <?php require_once('layout/header.php')?> 
 
<div class="container" style="text-align: left; padding-top:25px;">
     <br/><br/>
     <p>
     <br/><br />
    <p>

        <?php
        session_start();

        $database = "ebay_ece";

            //connectez vous sur votre base de donnée
            //Rappel: votre serveur = localhost | votre login = root | votre mot de passe = none
            $db_handle = mysqli_connect('localhost', 'root' , '');
            $db_found = mysqli_select_db($db_handle, $database);

            if($db_found)
                {
                    // afficher les items seulement s'il sont disponibles à l'achat immédiat
                    $sql = "SELECT * FROM `item` WHERE Type_de_vente_1 LIKE 'Achat Immediat' OR Type_de_vente_2 Like 'Achat Immediat' ";
                    $result = mysqli_query($db_handle, $sql); ?>
                    <!--bouton retour -->
                    <a href = "Choix_du_type.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>

                    <h1><?php echo "Magasin:" . "<br>";?></h1>
                    <?php echo "<br>";
                    while ($data = mysqli_fetch_assoc($result)) 
                    { 
                        // afficher les information de l'item 
                        echo "<br>"; 
                        echo "Nom: " . $data['Nom_item'] . "<br>";
                        $image = $data['Photo_item'];
                        echo "<td>" . "<img src='$image' height='120' width='100'>" ."</td> <br>";
                        echo "Description: " . $data['Description_item'] . "<br>";
                        echo "Vidéo: " . $data['Video_item'] . "<br>";
                        echo "Prix: " . $data['Prix_item'] . "<br>";
                        echo "Date de fin: " . $data['date_de_fin_item'] . "<br>";
                        echo "Type de vente 1: " . $data['Type_de_vente_1'] . "<br>";
                        echo "Type de vente 2: " . $data['Type_de_vente_2'] . "<br>";
                        echo "Categorie: " . $data['Categorie_item'] . "<br>";
                        echo "<br>"; 
                    }  
                }
                else
                {
                    echo "data base not found";
                }
        ?>
                 

<br>
    <!-- acceder à "panier.php" si le bouton "mettre dans le panier" est cliqué -->
    <form action="panier.php" method="post" style="width: 1200px;">
            <tr>
            <td><b>Nom de l'item que vous voulez mettre dans le panier: </b>
            <div class="form-group">
                <input type="text" class="form-control" name="nomitem"></td></div></tr>
            <tr><b>Prix de l'item que vous voulez mettre dans le panier: </b>
            <div class="form-group">
                <input type="number" class="form-control" name="prixitem"></tr></div>
            <tr><div class="form-group">
                <input type="submit" class="btn btn-primary" name="Panier" value="Mettre dans le panier"></div></tr>
        <br><br>
    </form>
    <!-- acceder à "paiement.php" si le bouton "mettre dans le panier" est cliqué -->
    <form action="payement.php" method="post" style="width: 1200px;">
            <tr>
            <td><b>Nom de l'item que vous voulez directement acheter: </b>
            <div class="form-group">
                <input type="text" class="form-control" name="nomitem"></td></div></tr>
            <tr><b>Prix de l'item que vous voulez directement acheter: </b>
            <div class="form-group">
                <input type="number" class="form-control" name="prixitem"></tr></div>
            <tr><div class="form-group">
                <input type="submit" class="btn btn-primary" name="Panier" value="Achetez-le Maintenant"></div></tr>
        <br><br>
    </form>

        
    
</body>
</html>