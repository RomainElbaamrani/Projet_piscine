<?php 
    if(!isset($_SESSION['id_admin']) || !isset($_SESSION['id_client']) || !isset($_SESSION['id_vendeur']))
    {
        echo "deconnexion.php";
    }
    else
    {
        if (isset($_SESSION['id_admin'])) {
            echo "connexionAdmin.html";
        } elseif (isset($_SESSION['id_client'])) {
            echo "connexionVendeur.html";
        } elseif (isset($_SESSION['id_vendeur'])) {
            echo "connexionAcheteur.html";
        }
    } 
?>