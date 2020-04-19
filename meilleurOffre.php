
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('layout/dependencies.php')?>
    <title>Meilleure offre</title>
</head>
<body>
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
            $db_handle = mysqli_connect('localhost', 'root' , '');
            $db_found = mysqli_select_db($db_handle, $database);

            if($db_found)
            {
                // sélectionner tous les items disponibles en meilleure offre 
                $sql = "SELECT * FROM `item` WHERE Type_de_vente_1 LIKE 'Meilleure Offre' OR Type_de_vente_2 Like 'Meilleure Offre'";
                $result = mysqli_query($db_handle, $sql); ?>
                <a href = "Choix_du_type.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>

                <h1><?php echo "Items disponibles dans meilleure offre:" . "<br>";?></h1>
                <?php echo "<br>";
                while ($data = mysqli_fetch_assoc($result)) 
                { 
                    // afficher les items disponibles dans meilleures offres
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
    <form action="meilleurOffre1.php" method="post" style="width: 1200px;">
            <tr>
            <td><b>Nom de l'item que vous desirez </b>
            <div class="form-group">
                <input type="text" class="form-control" name="nomitem"></td></div>
                <td><b>Prix proposé</b>
            <div class="form-group">
                <input type="text" class="form-control" name="prix"></td></div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="Negocier" value="Negocier"></div>
        </tr>
        <br><br>
    </form>

        
    
</body>
</html>