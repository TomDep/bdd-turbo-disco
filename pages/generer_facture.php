<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Générer une facture</title>
        <?php  include("../templates/links.php");  ?>
    </head>
    <body>
    <?php  include("../templates/menu.php");  ?>

    <?php
    require_once '../lib/Commande.php';
    require_once '../lib/Client.php';
    require_once '../lib/ArticleCommande.php';

    $client1 = new Client(
        955121,
        "De Pasquale",
        "Tom",
        "Silver",
        "Tom de Pasquale",
        "@tom_depasquale",
        "tomdepasquale1@gmail.com");

    $commande1 = new Commande(86534, $client1);
    $commande1->changerStatut(StatutCommande::en_cours);
    $commande1->ajouterCommentaire("Cette commande est prise en charge par Tom de Pasquale.");
    $commande1->ajouterArticle(new ArticleCommande(652, "Caudalie Duo Levre Main", 1, 13.00));
    $commande1->ajouterArticle(new ArticleCommande(5563, "Nuxe lait corps 200ml", 2, 18.00));

    ?>

    <div class="container p-5">

        <h1>Création d'une facture</h1>

        <hr>

        <div>
            <h4>Sélection des articles</h4>

            <form action="../lib/generer_facture.php" method="post">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Sélectionner</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Prix total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $articles = $commande1->recupererArticles();
                        foreach ($articles as $i => $article) {
                            echo "<tr>";
                            echo "<td><input name='". $article->id ."' type='checkbox' checked></td>";
                            $article->afficherInfos();
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <button class="btn btn-primary" type="submit">Générer la facture</button>
            </form>
        </div>

    </div>

    </body>
</html>