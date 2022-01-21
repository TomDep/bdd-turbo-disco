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

$db = creerConnexion();
$commande = creerCommande($_GET['id_commande']);

?>

<div class="container p-5 mt-4 rounded shadow-lg">
    <h1>Création d'une facture pour la commande n°<?php echo $commande->id ?> </h1>

    <div class="border rounded mt-3 p-3">
        <h4>Choix des articles :</h4>

        <form action="facture_details.php?id_commande=<?php echo $commande->id ?>" method="post">

            <table class="table">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>Nom de l'article</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Prix total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($commande->articles as $article) {
                    echo '<tr>';

                    echo '<td><input class="form-check" type="checkbox" checked name="'. $article->id .'"></td>';
                    echo '<td>'. $article->intitule .'</td>';
                    echo '<td>'. $article->quantite .'</td>';
                    echo '<td>'. $article->prix_unite .'</td>';
                    echo '<td>'. $article->recupererTotal() .'</td>';

                    echo '</tr>';
                }
                ?>

                </tbody>
            </table>

            <input type="submit" class="btn btn-primary" value="Continuer">
            <a class="btn btn-outline-secondary secondary" href="commande.php?id_commande=<?php echo $commande->id ?>">Retour</a>

        </form>

    </div>
</div>
</body>
</html>