<?php

require_once '../lib/Commande.php';
require_once '../lib/ArticleCommande.php';
require_once '../lib/Client.php';
require_once '../lib/Utils.php';
require_once '../lib/connexion.php';

session_start();

$commande = $_SESSION["commande"];

$db = creerConnexion();
if(!$commande->ajouterBDD()) {
    //echo '<p>Erreur : ' . $db->error . '</p>';
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
    <h1>La commande n°<?php echo $commande->id ?> a été passée avec succès</h1>

    <a class="btn btn-primary mt-3" href="commande.php?id_commande=<?php echo $commande->id ?>">Voir la nouvelle commande</a>
</div>

</body>


<?php
    // Removing the command object
    unset($_SESSION["commande"]);

?>
