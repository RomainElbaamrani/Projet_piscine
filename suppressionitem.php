
<html>
<head>
    <title>Supprimer item</title>
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

        // si l'utilisateur connecté est un administrateur, on affiche tous les items en magasin
        if(isset($_SESSION["id_admin"]))
        {
            if($db_found)
            {
                $id_admin = $_SESSION["id_admin"];
                $sql = "SELECT * FROM `item`";
                $result = mysqli_query($db_handle, $sql); ?>

                <a href = "Admin_gestion_items.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>
                <h1><?php echo "Tous les items disponibles en magasin :" . "<br>";?></h1>
                <?php echo "<br>";

                while ($data = mysqli_fetch_assoc($result)) 
                { 
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
        }
        // si l'utilisateur connecté est un vendeur, on affiche seulement les items que le vendeur a mis en vente
        else
        {
            $id_vendeur = $_SESSION["id_vendeur"];
            $sql = "SELECT * FROM `item` WHERE idVendeur LIKE $id_vendeur";
            $result = mysqli_query($db_handle, $sql); ?>

            <a href = "Admin_gestion_items.php" class="breadcrumb-item"> <i class="fas fa-long-arrow-alt-left"> </i> Previous page</a>
            <h1><?php echo "Vos items:" . "<br>";?></h1>
            <?php echo "<br>";

            while ($data = mysqli_fetch_assoc($result)) 
            { 
                echo "<br>"; 
                echo "Nom: " . $data['Nom_item'] . "<br>";
                echo "Photo: " . $data['Photo_item'] . "<br>";
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
            ?>
        <br>
                <form action="suppressionitem1.php" method="post" style="width: 1200px;">
                    <tr>
                        <td><b>Nom de l'item que vous voulez supprimer: </b>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nomitem"></td>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="supprimer" value="Supprimer">
                        </div>
                    </tr>
                    <br><br>
                </form>
    </div>
</body>
</html>