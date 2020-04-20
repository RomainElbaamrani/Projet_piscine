<?php

session_start();

    $nomitem = isset($_POST["nomitem"])? $_POST["nomitem"] : "";
    $prix = isset($_POST["prix"])? $_POST["prix"] : "";

    

	$database = "ebay_ece";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $erreur ="";

    // vérifier si les champs nom de l'item et prix sont remplis 
    if ($nomitem == ""){
        $erreur .= "Le champ identifiant est vide.<br>";
    }
    if ($prix == ""){
        $erreur .= "le champ mot de passe est vide.<br>";
    }
    // stocker la variables id client
    $id_client = $_SESSION["id_client"];

    if($erreur =="")
    {
        if ($db_found) 
        {    
            $sql = "SELECT * FROM item";    
            if ($nomitem != "") 
            {     
                // vérifier si l'item est dans le magasin
                $sql .= " WHERE Nom_item LIKE '$nomitem'";     
            }    
            $result = mysqli_query($db_handle, $sql);  
            // si l'item n'est pas dans la bdd, afficher un message d'erreur
            if (mysqli_num_rows($result) == 0) 
            {     
                //l'item est inexistant     
                echo "l'item n'est pas dans la base de données. <br>";    
            }   
            //sinon, récupérer l'id de l'item
            else 
            {     
                while ($data = mysqli_fetch_assoc($result) ) 
                {      
                    // récuperer l'id de l'item 
                    $id_item = $data['idItem'];      
                } 


                // créer une ligne dans le tableau meilleur offre et stocker l'id client, l'id item, le prix proposé et le nombre de negociation restant
                $sql = "INSERT INTO `meilleure_offre`(`idClient`, `idItem`, `Prix_negociation`, `nb_negociation`) VALUES ('$id_client','$id_item','$prix','5')";     
                
                $result = mysqli_query($db_handle, $sql); 
                //rediriger vers la page acheteur     
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