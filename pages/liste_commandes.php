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
$commande2->changerStatut(StatutCommande::livree);

$commandes = [$commande1, $commande2];
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