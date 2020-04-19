<?php

session_start();

	$nomitem = isset($_POST["nomitem"])? $_POST["nomitem"] : "";

	$database = "ebay_ece";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

        if ($db_found) 
        {    
            $sql = "SELECT * FROM item";    
            if ($nomitem != "") 
            {     
                $sql .= " WHERE Nom_item LIKE '$nomitem'";     
            }    
            $result = mysqli_query($db_handle, $sql);    
            if (mysqli_num_rows($result) == 0) 
            {     
                //item inexistant     
                echo "On ne peut pas l'effacer car l'item n'est pas dans la base de données. <br>";    
            }   
            else 
            {     
                while ($data = mysqli_fetch_assoc($result) ) 
                {      
                    $nomitem = $data['Nom_item'];      
                    echo "<br>";     
                } 

                //supprimer l'item sélectionné à partie de son nom
                $sql = "DELETE FROM item";     
                $sql .= " WHERE Nom_item = '$nomitem'";     
                $result = mysqli_query($db_handle, $sql);     
                echo "On a supprimé l'item. <br>"; 

    
                //on affiche les autres livres dans la BDD     
                $sql = "SELECT * FROM item";     
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
                header('Location: suppressionitem.php');
            }
        }
        else
        {    
            echo "Database not found";   
        }
    
 
 //fermer la connexion  
 mysqli_close($db_handle); 
?>