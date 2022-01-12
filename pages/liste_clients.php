<!DOCTYPE html>
<?php
//paramètres de connexion à la base de données

    require_once '../lib/connexion.php';
    $db = creerConnexion();

?>

<html lang="fr">
<head>
    <title>Liste des fiches clients</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<?php
require_once "../lib/Client.php";
?>

<div class="container p-5">

    <ul class="list-group">
    <?php
    if(isset($_GET['supprimer'])){

        $db->query("DELETE FROM adresse WHERE id_adresse=".$_GET['supprimer']);

    }
    if(isset($_GET['supprimer_num'])){

        $db->query("DELETE FROM numerotelephone WHERE numero=".$_GET['supprimer_num']);

    }

    $clients = creerListeClients();

    foreach ($clients as $client) {
    ?>
                <li class="list-group-item"><?php $client->afficherApercu(); ?></li>
    <?php
    }
    ?>
    </ul>
</div>

</body>
</html>
