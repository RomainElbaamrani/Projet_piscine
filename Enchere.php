<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('layout/dependencies.php')?>
    <title>Magasin</title>
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


            $db_handle = mysqli_connect('localhost', 'root' , '');
            $db_found = mysqli_select_db($db_handle, $database);

            if($db_found)
                {
                    // sélectionner les items du magasin disponible en enchère et les afficher 
                    $sql = "SELECT * FROM `item` WHERE Type_de_vente_1 LIKE 'Encheres' OR Type_de_vente_2 Like 'Encheres' ";
                    $result = mysqli_query($db_handle, $sql); ?>
                    <a href = "Choix_du_type.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>

                    <h1><?php echo "Enchérissez sur l'objet que vous souhaitez:" . "<br>";?></h1>
                    <?php echo "<br>";
                    while ($data = mysqli_fetch_assoc($result)) 
                    { 
                        // afficher les items disponibles en enchère 
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
    <form action="Enchere1.php" method="post" style="width: 1200px;">
            <tr>
            <td><b>Nom de l'item que vous voulez enchérir: </b>
            <div class="form-group">
                <input type="text" class="form-control" name="nom"></td></div>
            <td><b>Prix de l'item: </b>
            <div class="form-group">
                <input type="text" class="form-control" name="prix"></td></div>
            <td><b>Date de finde disponibilité:  </b>
            <div class="form-group">
                <input type="text" class="form-control" name="dates"></td></div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="Negocier" value="Enchérir"></div>
        </tr>
        <br><br>
    </form>

        
    
</body>
</html>