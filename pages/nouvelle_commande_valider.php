<?php

require_once '../lib/Commande.php';
require_once '../lib/ArticleCommande.php';
require_once '../lib/Client.php';

session_start();

$commande = $_SESSION["commande"];
$commande->ajouterBDD();

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

</div>

</body>

