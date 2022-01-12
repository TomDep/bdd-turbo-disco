<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Éditer une commande</title>
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
    "tomdepasquale1@gmail.com",
    957.60,
    0,
    false
);

$commande1 = new Commande(86534, $client1);
$commande1->changerStatut(StatutCommande::en_cours);
$commande1->ajouterCommentaire("Cette commande est prise en charge par Tom de Pasquale.");
$commande1->ajouterArticle(new ArticleCommande(652, "Caudalie Duo Levre Main", 1, 13.00));
$commande1->ajouterArticle(new ArticleCommande(5563, "Nuxe lait corps 200ml", 2, 18.00));
?>

<div class="container p-5">
    <div class="row">
        <div class="col">
            <table class="mb-3">
                <h4>Commande <span>n°<?php echo $commande1->getId(); ?></span></h4>
                <tr>
                    <td><?php $commande1->afficherIconeStatut(); ?></td>
                    <td><?php $commande1->afficherNomStatut(); ?></td>
                    <td><?php $commande1->afficherDerniereDate(); ?></td>
                    <td></td>
                </tr>
            </table>

            <?php
            $statut = $commande1->recupererStatus();
            switch($statut) {
                case StatutCommande::attente_validation:
                    echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande1->getId() ."&statut_actuel=". $commande1->recupererStatus() ."' class='btn btn-success'>Valider la commande</a>";
                    break;
                case StatutCommande::en_cours:
                    echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande1->getId() ."&statut_actuel=". $commande1->recupererStatus() ."' class='btn btn-success'>Valider que la commande a bien été livrée</a>";
                    break;
            }

            ?>

            <a href="../lib/annuler_commande.php?id_commande=<?php echo $commande1->getId(); ?>" class="btn btn-danger">Annuler la commande</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <a href="generer_facture.php?id_commande=<?php echo $commande1->getId(); ?>" class="btn btn-outline-secondary">Générer la facture</a>
        </div>
        <?php $commande1->afficherArticlesEdition(); ?>
    </div>
</div>

</body>
</html>