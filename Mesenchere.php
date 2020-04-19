
<html>
<head>
    <title>Mes offres</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <?php require_once('layout/dependencies.php')?>
    <script type="text//javascript" href="pageinscriptionacheteur.js">   </script>
    <link rel="stylesheet" type="text/css" href="suppressionitem.css">
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
    //Rappel: votre serveur = localhost | votre login = root | votre mot de passe = none
    $db_handle = mysqli_connect('localhost', 'root' , '');
    $db_found = mysqli_select_db($db_handle, $database);

    // si connecté en temps qu'admin 
    if(isset($_SESSION["id_admin"]))
        {
            if($db_found)
            {
                //récuperer l'id admin connecté 
                $idAdmin_session = $_SESSION["id_admin"];
                $sql = "SELECT * FROM `item` INNER JOIN encherir ON item.idItem = encherir.idItem";
                $result = mysqli_query($db_handle, $sql); ?>

                <a href = "Admin_page_gestions.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>
                <h1><?php echo "client intéressé par un item" . "<br>";?></h1>
                <?php echo "<br>";

                while ($data = mysqli_fetch_assoc($result)) 
                { 
                    echo "<br>"; 
                    //récuperer l'id de l'item, de l'admin et du client 
                    $idItem = $data['idItem']; 
                    $idAdmin_tab = $data['idAdmin'];
                    $idClient = $data['idClient'];

                    $sql2 = "SELECT * FROM `client` WHERE idClient like $idClient";
                    $result2 = mysqli_query($db_handle, $sql2);
                    while ($data2 = mysqli_fetch_assoc($result2)) 
                    { 

                        //comparer l'id de l'admin connecté et de l'id admin dans la table enchèrir
                        if($idAdmin_session == $idAdmin_tab)
                        {
                            echo "<br>"; 
                            echo "Nom de l'acheteur: " . $data2['Nom_client'] . "<br>";
                            echo "Item concerné: " . $data['Nom_item'] . "<br>";
                            echo "Prix proposé: " . $data['prixEncheri'] . " € <br>";
                            echo "Date: " . $data['dateEncheri'] . " € <br>";
                            echo "<br>"; 
                        }
                        else
                        {
                            echo "<h3> Aucun client n'est interessé par l'un de vos item <br>";
                        }
 
                    }
                }    
                
            }  
        }
        
        // sinon connecté en temps que vendeur 
        elseif(isset($_SESSION["id_vendeur"]))
        {
            if($db_found)
            {
                //récuperer l'id du vendeur connecté 
                $idVendeur_session = $_SESSION["id_vendeur"];
                $sql = "SELECT * FROM `item` INNER JOIN encherir ON item.idItem = encherir.idItem";
                $result = mysqli_query($db_handle, $sql); ?>

                <a href = "Admin_gestion_items.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>
                <h1><?php echo "client intéressé par un item" . "<br>";?></h1>
                <?php echo "<br>";

                while ($data = mysqli_fetch_assoc($result)) 
                { 
                    echo "<br>"; 
                    //récuperer l'id de l'item, du vendeur et du client 
                    $idItem = $data['idItem']; 
                    $idVendeur_tab = $data['idVendeur'];
                    $idClient = $data['idClient'];

                    $sql2 = "SELECT * FROM `client` WHERE idClient like $idClient";
                    $result2 = mysqli_query($db_handle, $sql2);
                    while ($data2 = mysqli_fetch_assoc($result2)) 
                    { 
                        //comparer l'id du vendeur connecté et du vendeur dans la table enchèrir
                        if($idVendeur_session = $idVendeur_tab)
                        {
                            echo "<br>"; 
                            echo "Nom de l'acheteur: " . $data2['Nom_client'] . "<br>";
                            echo "Item concerné: " . $data['Nom_item'] . "<br>";
                            echo "Prix proposé: " . $data['prixEncheri'] . " € <br>";
                            echo "Date : " . $data['dateEncheri'] . " € <br>";
                            echo "<br>"; 
                        }
                        elseif($idVendeur_session != $idVendeur_tab)
                        {
                            echo "<h3> Aucun client n'est interessé par l'un de vos item <br>";
                        }
                    }
                }
                    
            }
            else
            {
                echo "database nor found";
            }

        }
    ?>
    <br>
            <form action="suppressionitem1.php" method="post" style="width: 1200px;">
                   <tr>
                    <td><b>Offre proposé </b>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="supprimer" value="Refuser l'offre"></div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" name="supprimer" value="Conclure l'offre"></div>
                </tr>
                <br><br>
            </form>
    </form>
</div>
</div>
</body>
</html>