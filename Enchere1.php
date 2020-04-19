<?php

session_start();


    // récuperer le nom, a date et le prix de l'item
    $nomitem = isset($_POST["nom"])? $_POST["nom"] : "";
    $prix = isset($_POST["prix"])? $_POST["prix"] : "";
    $dates = isset($_POST["dates"])? $_POST["dates"] : "";

    

	$database = "ebay_ece";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $id_client = $_SESSION["id_client"];
    $Nom_client = $_SESSION["Nom_client"];

    $erreur ="";

    if($erreur =="")
    {
        if ($db_found) 
        {    // vérifier si l'item est dans la bdd
            $sql = "SELECT * FROM item";    
            if ($nomitem != "") 
            {     
                $sql .= " WHERE Nom_item LIKE '$nomitem'";     
            }    
            $result = mysqli_query($db_handle, $sql);   
            // si non disponible dans la bdd 
            if (mysqli_num_rows($result) == 0) 
            {     
                //Livre inexistant     
                echo "l'item n'est pas dans la base de données. <br>";    
            }  
            // sinon récuperer d'id de l'item dans la bdd 
            else 
            {     
                while ($data = mysqli_fetch_assoc($result) ) 
                {      
                    $id_item = $data['idItem'];      
                    echo "<br>";     
                } 


                // inserer dans le tableau enchérir les infos: id client, id item, prix de l'enchère et date de fin 
                $sql = "INSERT INTO `encherir`(`idClient`, `idItem`, `prixEncheri`, `dateEncheri`) VALUES ('$id_client','$id_item','$prix','$dates')";     
                
                $result = mysqli_query($db_handle, $sql);     

    
                //on affiche les autres livres dans la BDD     
                $sql = "SELECT * FROM 'encherir'";     
                $result = mysqli_query($db_handle, $sql);     
                echo "Il vous reste ces items: <br>";     
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
                header('Location: Choix_du_type.php');
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
    
 
 //fermer la connexion  mysqli_close($db_handle); 
?>