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
$commande1 = new Commande(86534);
$commande1->changerStatut(StatutCommande::attente_validation);

$commande2 = new Commande(3654156);
$commande2->changerStatut(StatutCommande::en_cours);

$commande3 = new Commande(69545);
$commande3->changerStatut(StatutCommande::livree);

$commande4 = new Commande(358654);
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