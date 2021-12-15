<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des fiches clients</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<?php

require_once "../lib/Client.php";

$client1 = new Client(
        955121,
        "De Pasquale",
        "Tom",
        "Silver",
        "Tom de Pasquale",
        "@tom_depasquale",
        "tomdepasquale1@gmail.com");

$client2 = new Client(
        1565325645,
        "Soulan",
        "Guilhem",
        "Gold",
        "Guilhem Soulan",
        "@guigui",
        "guilhemsoulan@gmail.com");

$clients = [$client1, $client2];
?>

<div class="container p-5">

    <ul class="list-group">
    <?php
    foreach ($clients as $client) { ?>
        <li class="list-group-item"><?php $client->afficherApercu(); ?></li><?php
    }
    ?>
    </ul>
</div>

</body>
</html>