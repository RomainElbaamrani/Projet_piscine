<?php

session_start();

//echo $_SESSION["id_vendeur"];

	$vendeur = isset($_POST["nom_vendeur"])? $_POST["nom_vendeur"] : "";

	$database = "ebay_ece";
 
    //connectez-vous dans BDD

    $db_handle = mysqli_connect('localhost', 'root', '');

    $db_found = mysqli_select_db($db_handle, $database);


		if ($db_found) {    
        $sql = "SELECT * FROM vendeur";    
        if ($vendeur != "") {     
        $sql .= " WHERE Nom_vendeur LIKE '$vendeur'";     
         }    
        $result = mysqli_query($db_handle, $sql);    
        if (mysqli_num_rows($result) == 0) {     
        //vendeur inexistant     
            echo "On ne peut pas l'effacer car le vendeur n'est pas dans la base de données. <br>";    
        }   
        else 
        {     
            while ($data = mysqli_fetch_assoc($result) ) 
            {      
                $vendeur = $data['Nom_vendeur'];      
                echo "<br>";     
            } 

            // supprimer le vendeur à partie de son nom 
            $sql = "DELETE FROM vendeur";     
            $sql .= " WHERE Nom_vendeur = '$vendeur'";     
            $result = mysqli_query($db_handle, $sql);     
            echo "On a supprimé le vendeur. <br>"; 
 
            //on affiche les autres livres dans la BDD     
            $sql = "SELECT * FROM vendeur";     
            $result = mysqli_query($db_handle, $sql);     
            echo "Il ne reste que ses vendeur: <br>";     
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
            header('Location: suppressionvendeur.php');

        }
    }
    else
    {    
        echo "Database not found";   
    }  
 
 //fermer la connexion  
 mysqli_close($db_handle); 

?>