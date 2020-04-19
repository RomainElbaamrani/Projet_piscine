<html>
<head>
    <title>Supprimer vendeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <?php require_once('layout/dependencies.php')?>
    <script type="text//javascript" href="pageinscriptionacheteur.js"></script>
    <link rel="stylesheet" type="text/css" href="payement.css">
</head>
<body>
    <?php require_once('layout/header.php')?>
    <div class="container" style="text-align: left; padding-top:25px;">
         <br /><br/>
         <p>
         <br /><br />
        <p><?php 
        session_start();
        $database = "ebay_ece";

        //connectez vous sur votre base de donnée
        //Rappel: votre serveur = localhost | votre login = root | votre mot de passe = none
        $db_handle = mysqli_connect('localhost', 'root' , '');
        $db_found = mysqli_select_db($db_handle, $database);

            if($db_found)
            {
                //sélection de tous les vendeurs 
                $sql = "SELECT * FROM `vendeur`";
                $result = mysqli_query($db_handle, $sql); ?>
                <a href = "Admin_page_vendeur.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>

                <h1><?php echo "Les vendeurs sont :" . "<br>";?></h1>
                <?php echo "<br>";

                // afficher la liste des vendeurs 
                while ($data = mysqli_fetch_assoc($result)) 
                { 
                    echo "<br>"; 
                    echo "Nom: " . $data['Nom_vendeur'] . "<br>";
                    echo "Photo: " . $data['Photo_vendeur'] . "<br>";
                    echo "Image de fond d'écran: " . $data['image_de_fond_vendeur'] . "<br>";
                    echo "Pseudo: " . $data['Pseudo_vendeur'] . "<br>";
                    echo "Email: " . $data['Email_vendeur'] . "<br>";
                    echo "<br>"; 
                }  
            }?>
        <br>
    <form action="suppressionvendeur1.php" method="post" style="width: 1200px;">
        <tr>
            <td><b>Nom du vendeur que vous voulez supprimer: </b>
            <div class="form-group"> <input type="text" class="form-control" name="nom_vendeur"></td></div>
            <div class="form-group">    <input type="submit" class="btn btn-primary" name="supprimer" value="Supprimer"></div>
        </tr>
        <br><br>
    </form>
    </div>
</p></p>
</body>
</html>