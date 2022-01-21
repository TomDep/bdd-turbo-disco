<?php
require_once '../lib/Commande.php';
require_once '../lib/Client.php';
require_once '../lib/connexion.php';
require_once '../lib/Utils.php';
require_once '../lib/ArticleCommande.php';

session_start();

if(!isset($_POST["client_full"]) && !isset($_SESSION["commande"])) {
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

    <h1 class="mb-3">Création d'une nouvelle commande</h1>

    <h4 class="mb-3">Client : <?php
        if(isset($_SESSION["commande"])) {
            echo $commande->client->getNomPrenom();
        } else {
            echo explode('#', $_POST["client_full"])[0];
        } ?>
    </h4>

    <?php
    if(count($commande->articles) > 0) {
        echo '<a class="btn btn-primary" href="nouvelle_commande_valider.php">Créer la commande</a>';
    } else {
        echo '<a class="disabled btn btn-primary" href="nouvelle_commande_valider.php">Créer la commande</a>';
    }
    ?>

    <a class="btn btn-secondary" href="nouvelle_commande.php?annuler_commande=1">Annuler</a>

    <div class="mt-3 row border rounded">
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
                        echo '<tr>';
                        echo '<td>' . $article->intitule . '</td>';
                        echo '<td>' . $article->quantite . '</td>';
                        echo '<td>' . formaterPrix($article->prix_unite) . '</td>';
                        echo '<td>' . formaterPrix($article->recupererTotal()) . '</td>';
                        echo '</tr>';
                    }
                ?>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="fw-bold">Total</td>
                        <td class="fw-bold"><?php echo formaterPrix($commande->calculerPrixTotal()) ?></td>
                    </tr>
                </tfoot>

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

            <table id="table" class="table">
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
                    echo '<tr>';
                    echo '<form id="row-'. $article["id_article"] .'" method="GET" action="nouvelle_commande_ajouter_article.php">';
                    echo '<input hidden name="id_article" value="'. $article["id_article"] .'">';

                    echo '<td>' . $article["intitule"] . '</td>';
                    echo '<td>' . formaterPrix($article["prix_unitaire"]) . '</td>';
                    echo '<td>' . $article["intitule_status_article"] . '</td>';
                    echo '<td class="input-group-sm">
                            <input required class="form-control" type="number" name="quantite" style="width: 30px; -moz-appearance: textfield;">
                          </td>';
                    echo '<td>
                            <button type="submit" class="btn-outline-primary btn btn-sm">+</button>
                          </td>';

                    echo '</form>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>