<?php
        session_start();
        $database = "ebay_ece";

        //connectez vous sur votre base de donnée
        //Rappel: votre serveur = localhost | votre login = root | votre mot de passe = none
        $db_handle = mysqli_connect('localhost', 'root' , '');
        $db_found = mysqli_select_db($db_handle, $database);

        // verifier le type de connexion (admin, vendeur ou acheteur)
        if(isset($_SESSION["id_admin"]))
        {
            if($db_found)
            {
                $id_admin = $_SESSION["id_admin"];
                $sql = "SELECT * FROM `admin` WHERE idAdmin Like $id_admin";
                $result = mysqli_query($db_handle, $sql);
            }
        }
        else if(isset($_SESSION["id_client"]))
        { if($db_found)
            {
                $id_client = $_SESSION["id_client"];
                $sql = "SELECT * FROM `client` WHERE idClient LIKE $id_client";
                $result = mysqli_query($db_handle, $sql);
            }
        }
        else if(isset($_SESSION["id_vendeur"]))
        { if($db_found)
            {
                $id_vendeur = $_SESSION["id_vendeur"];
                $sql = "SELECT * FROM `vendeur` WHERE idVendeur LIKE $id_vendeur";
                $result = mysqli_query($db_handle, $sql);
            }
        }

        
    ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Mon compte</title>
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
        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
         <!-- si connecté en temps que client alors, affciher les informations du client-->
        <?php if(isset($_SESSION["id_client"])){ ?>
        Session Acheteur <br>   
        Nom: <?php echo $data['Nom_client']; ?>
        <br>
        Prénom: <?php echo $data['Prenom_client']; ?>
        <br>

        Adresse: <?php echo $data['Adresse_client']; ?>
        <br>
        E mail: <?php echo $data['Email_client']; ?>
        <br>
        Ville: <?php echo $data['Ville_client']; ?>
        <br>
        Code postal: <?php echo $data['Code_postal_client']; ?>
        <br>
        Téléphone: <?php echo $data['Tel_client']; ?>
        <br>
        <?php
         }
        ?>
<br>
         <!-- si connecté en temps que vendeur alors, afficher les informations du vendeur-->
        <?php if(isset($_SESSION["id_vendeur"])){ ?>
        Session Vendeur <br>
        Nom: <?php echo $data['Nom_vendeur']; ?><br>
        Pseudo: <?php echo $data['Pseudo_vendeur']; ?><br>
        Photo: <?php echo $data['Photo_vendeur']; ?><br>
     	E mail: <?php echo $data['Email_vendeur']; ?><br>
        <br>
        <?php
         }
        ?>

         <!-- si connecté en temps qu'administrateur, afficher les informations de l'administrateur-->
        <?php if(isset($_SESSION["id_admin"])){ ?>
        Session Administrateur <br>
        Nom: <?php echo $data['Nom_admin']; ?>
        <br>
        Prenom: <?php echo $data['Prenom_admin']; ?>
        <br>
        <!-- Password: <?php echo $data['Password_admin']; ?>
        <br> -->
        E mail: <?php echo $data['Email_admin']; ?>
        <br>
        <?php
         }
         ?>
        <?php
         }
         ?>
         <br><br>
        </p>
    </div>

</body>
</html>