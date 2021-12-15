<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top p-2">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="nav-item">
                    <a href="../index.php" class="nav-link">Accueil</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">Clients</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="fiche_client.php">Voir fiche client</a></li>
                        <li><a class="dropdown-item" href="liste_clients.php">Tous les clients</a></li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item" href="ajout_client.php">Ajouter un client</a></li>
                        <li><a class="dropdown-item" href="editer_fiche_client.php">Éditer fiche client</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">Commandes</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="commande.php">Voir une commande</a></li>
                        <li><a class="dropdown-item" href="liste_commandes.php">Toutes les commandes</a></li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item" href="nouvelle_commande.php">Créer une commande</a></li>
                        <li><a class="dropdown-item" href="editer_commande.php">Éditer une commande</a></li>
                        <li><a class="dropdown-item" href="supprimer_commande.php">Supprimer une commande</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="generer_facture.php">Générer une facture</a>
                </li>
            </ul>
        </div>
    </div>
</nav>