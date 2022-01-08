<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des commandes</title>
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
$commande1->changerStatut(StatutCommande::attente_validation);
$commande1->ajouterCommentaire("Cette commande est prise en charge par Tom de Pasquale.");
$commande1->ajouterArticle(new ArticleCommande(652, "Caudalie Duo Levre Main", 1, 13.00));
$commande1->ajouterArticle(new ArticleCommande(5563, "Nuxe lait corps 200ml", 2, 18.00));

$commande2 = new Commande(3654156, $client1);
$commande2->changerStatut(StatutCommande::en_cours);

$commande3 = new Commande(69545, $client1);
$commande3->changerStatut(StatutCommande::livree);

$commande4 = new Commande(358654, $client1);
$commande4->changerStatut(StatutCommande::annulee);

$commandes = [$commande1, $commande2, $commande3, $commande4];
?>

<div class="container p-5">
    <div class="accordion">
        <?php
        foreach ($commandes as $commande) {
            $commande->afficherAppercu();
        }
        ?>
    </div>

</div>
</body>
</html>