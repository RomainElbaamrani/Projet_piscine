<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('layout/dependencies.php')?> 
    <title>Panier</title>
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


    $nomitem = isset($_POST["nomitem"])? $_POST["nomitem"] : "";
    $prixitem = isset($_POST["prixitem"])? $_POST["prixitem"] : "";


    $erreur = "";
    $database = "ebay_ece";
    

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    
    if ($nomitem == ""){
        $erreur .= "Le champ Nom est vide.<br>";
    }
    if ($prixitem == ""){
        $erreur .= "Le champ Prix est vide.<br>";
    }

    if ($erreur =="")
    {
        if ($db_found) 
        {
            $id_client = $_SESSION["id_client"];
            $sql = "SELECT * FROM `item`";
            if($nomitem != "") 
            {
                //on cherche l'item avec les paramètres nom
                $sql .= " WHERE Nom_item Like '$nomitem'";
                if ($prixitem != "") 
                {
                    $sql .= "  AND Prix_item LIKE '$prixitem'";
                }
            }

            $result = mysqli_query($db_handle, $sql);
            //regarder s'il y a de résultat
            if (mysqli_num_rows($result) == 0) 
            {
                //l'item est déjà dans la BDD
                echo "L'item y est déjà !";
            } 
            else 
            {
                // selectionner le client associé au panier 
                $sql2 = "SELECT * FROM `client` WHERE idClient LIKE $id_client";
                $result2 = mysqli_query($db_handle, $sql2);
                while ($data2 = mysqli_fetch_assoc($result2)) 
                {
                    $Nom_client = $data2['Nom_client'];
                    //inserer une ligne dans le tableau panier avec les infos du client, de l'item et du prix de l'item
                    $sql= "INSERT INTO `panier`(`Nom_item`, `Nom_client`, `Prix_item`) VALUES ('$nomitem','$Nom_client','$prixitem') ";
                    $result = mysqli_query($db_handle, $sql);
                    $sql= "SELECT * FROM panier";
                    $result = mysqli_query($db_handle, $sql);?>
                    <a href = "Choix_du_type.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>
                    <h1><?php echo "Panier:" . "<br>";?></h1>
                    <?php echo "<br>";
                    while ($data = mysqli_fetch_assoc($result)) 
                    {
                        echo "Informations sur l'item ajoutées:" . "<br>";
                        echo "Nom: " . $data['Nom_item'] . "<br>";
                        echo "Prix: " . $data['Prix_item'] . "<br>";
                        echo "<br>";
                    } 
                }
            } 
        }
    }
 

?>
<br>
    <form action="payement.php" method="post" style="width: 1200px;">
            <tr>
            <td><b>Prix de l'item que vous voulez acheter </b>
            <div class="form-group">
                <input type="text" class="form-control" name="prixitem"></td></div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="AchatImmediat" value="Passer la commande"></div>
        </tr>
        <br><br>
    </form>

        
    
</body>
</html>