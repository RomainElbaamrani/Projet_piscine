<?php
    session_start();
    $database = "ebay_ece";

    //connectez vous sur votre base de donnée
    //Rappel: votre serveur = localhost | votre login = root | votre mot de passe = none
    $db_handle = mysqli_connect('localhost', 'root' , '');
    $db_found = mysqli_select_db($db_handle, $database);


    // si connecté en temps que client
    if(isset($_SESSION["id_client"]))
    { if($db_found)
        {
            // récupérer les informations du client connecté à la session
            $id_client = $_SESSION["id_client"];
            $sql = "SELECT * FROM `client` WHERE idClient LIKE $id_client";
            $result = mysqli_query($db_handle, $sql);
        }
    }
        
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>mon Panier</title>
	<?php require_once('layout/dependencies.php')?>
</head>
<body>
<?php require_once('layout/header.php')?>

    <div class="container" style="text-align: center; padding-top:25px">
        <br /><br />
         <?php 
         if(!empty($data['avatar']))
         { 
         ?>
         <img src="../img/Avatar/<?php echo $data['avatar']; ?>" width="150" style="margin-top: -40px">
         <?php 
         }
         ?>
         <p>
         <br /><br />
         <a href = "javascript:history.back()" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a></body>
        <br>
        <?php while ($data = mysqli_fetch_assoc($result)) 
        {   
            $idClient_tab = $data['idClient'];?>
            <!-- si d'id du client connecté apparaît dans le panier alors, on affiche les informations des items de son panier -->
            <?php if(isset($_SESSION["id_client"]) || $id_client == $idClient_tab)
            { ?> 
                <?php $sql2 = "SELECT * FROM `panier`WHERE $idClient_tab LIKE $id_client";
                    $result2 = mysqli_query($db_handle, $sql2);


                while($data2 = mysqli_fetch_assoc($result2))
                { ?>
                  <!-- afficher les informations du panier  -->
                    Nom de l'item:
                    <?php echo $data2['Nom_item'];?>
                    <br>
                    Prix de l'item: <?php echo $data2['Prix_item']; ?> € <br><br>
                    <?php
                }
            }
         }
        ?>
        <br> 
         <br><br>
        </p>
    </div>

</body>
</html>