<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Fiche client</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5">
<?php

require_once("../lib/FicheClient.php");

$client = new FicheClient(
        "De Pasquale",
        "Tom",
        "Silver",
        "Tom de Pasquale",
        "@tom_depasquale",
        "tomdepasquale1@gmail.com");

$client->ajouterAdresse(new Adresse(74, "Rue du Pré", 72000, "Le Mans"));
//$client->ajouterAdresse(new Adresse(2, "Cours de Assé", 72000, "Le Mans"));

$client->ajouterNumeroTelephone("+33 7 83 55 79 56");
$client->ajouterNumeroTelephone("+33 6 55 27 32 12");

$client->afficher();
?>
</div>

</body>
</html>