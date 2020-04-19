<?php
session_start();
session_destroy();
// si le bouton deconnexion est cliqué, stoper la session et retourner à la page index

header('Location: index.html');
?>