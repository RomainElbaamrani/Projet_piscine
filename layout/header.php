

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0F056B">
<a class="navbar-brand" href="#"><img src="Logo.jpg" width="80px">  ECE ebay</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                </ul>
                <?php
                if(!isset($deco))
                {?>
                        <form class="form-inline my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                        <!-- Si connecté en temps qu'acheteur, afficher le symbole panier dans le header -->
                        <?php if(isset($_SESSION['id_client']))
                        {?>
                                <li class="nav-item ">
                                        <a class="navbar-brand" href="MonPanier.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
                                </li>
                  <?php }?>
                
                        
                        <li class="nav-item">
                                <a class="navbar-brand" href="MonCompte.php"><i class="fas fa-user fa-2x"></i></a>
                        </li>
                        <li class="nav-item">
                                <a class="navbar-brand" href="<?php require_once("gestion.php")?>"><?php if(!isset($_SESSION['id_admin']) || !isset($_SESSION['id_client']) || !isset($_SESSION['id_vendeur']) ){echo "Deconnexion";}else{echo "Connexion";} ?></a>
                                </li>
                                </ul>
                        </form>
                <?php 
                }
                ?>                              
         </div>
</nav>