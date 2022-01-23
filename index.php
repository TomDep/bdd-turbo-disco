<?php

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Turbo disco</title>

        <?php  include("templates/links.php");  ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-2">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">

                        <li class="nav-item">
                            <a href="#" class="nav-link">Accueil</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">Clients</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="pages/liste_clients.php">Tous les clients</a></li>

                                <li><hr class="dropdown-divider"></li>

                                <li><a class="dropdown-item" href="pages/ajout_client.php">Ajouter un client</a></li>

                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">Commandes</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pages/liste_commandes.php">Toutes les commandes</a></li>

                                <li><hr class="dropdown-divider"></li>

                                <li><a class="dropdown-item" href="pages/nouvelle_commande.php">Créer une commande</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>
