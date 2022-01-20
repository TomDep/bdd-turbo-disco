<?php
require_once '../lib/Commande.php';
require_once '../lib/Client.php';
require_once '../lib/connexion.php';

session_start();

if(!isset($_POST["client_full"])) {
    header('Location: nouvelle_commande.php');
    exit();
}

// Creer la commande si elle n'existe pas déjà
if(!isset($_SESSION["commande"])) {
    $id_client = explode('#', $_POST["client_full"])[1];

    $client = creerClient($id_client);
    // L'id n'est pas encore définie
    $commande = new Commande(-1, $client);
    $_SESSION["commande"] = $commande;
} else {
    $commande = $_SESSION["commande"];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer une nouvelle commande</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5 mt-4 rounded shadow-lg">

    <h4>Ajout des articles</h4>

    <div class="mt-5 row border rounded">
        <div class="col">
            <h5 class="mt-3">Articles présents dans la commande</h5>

            <?php
                if(count($commande->articles) == 0) {
                    echo '<td>Il n\'y a pas d\'articles dans votre commande !</td>';
                } else {?>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix unité</th>
                    <th scope="col">Prix total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($commande->articles as $i => $article) {
                        echo '<td>' . $article->intitule . '</td>';
                        echo '<td>' . $article->quantite . '</td>';
                        echo '<td>' . $article->prix_unite . '</td>';
                        echo '<td>' . $article->recupererTotal() . '</td>';
                    }
                ?>
                <tr class="table-active">
                    <td></td>
                    <td></td>
                    <td class="fw-bold">Total</td>
                    <td class="fw-bold"><?php echo $commande->calculerPrixTotal(); ?></td>
                </tr>
                </tbody>
            </table>
            <?php } ?>
        </div>
        <div class="col">
            <h5 class="mt-3">Articles du catalogue</h5>

            <form class="float-right mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="i-search">Rechercher</label>
                    </div>
                    <input id="i-search" class="form-control filter" data-tablefilter="#table" type="search" placeholder="Nom du produit">
                </div>
            </form>

            <table id="table">
                <thead>
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Status</th>
                    <th scope="col">Qté</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php

                $db = creerConnexion();
                $result = $db->query("SELECT id_article, intitule, prix_unitaire, intitule_status_article FROM article NATURAL JOIN statusarticle");

                if(!$result) {
                    echo '<p class="text-danger">' . $db->error . '</p>';
                }

                while ($article = $result->fetch_assoc()) {
                    echo '<td>' . $article["intitule"] . '</td>';
                    echo '<td>' . $article["prix_unitaire"] . '</td>';
                    echo '<td><input type="number" name="quantite"></td>';
                    echo '<td><a href="ajouter_article" onclick=\'document.getElementById("row-' . $article["id_article"] . '").submit();\'>Ajouter</a></td>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>