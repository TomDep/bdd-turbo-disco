<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Commande</title>

    <?php  include("../templates/links.php");  ?>
</head>
<body>
    <?php  include("../templates/menu.php");  ?>

<?php

if(!isset($_GET["id_commande"])) {
    header("Location: liste_commandes.php");
}

require_once '../lib/Commande.php';
require_once '../lib/connexion.php';

$commande = creerCommande($_GET["id_commande"]);
$db = creerConnexion();

?>

<div class="container p-5">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="liste_commandes.php">Liste des commandes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Commande</li>
        </ol>
    </nav>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-informations-tab" data-bs-toggle="tab" data-bs-target="#nav-informations" type="button" role="tab">Informations de la commande</button>
            <button class="nav-link" id="nav-factures-tab" data-bs-toggle="tab" data-bs-target="#nav-factures" type="button" role="tab">Factures</button>
        </div>
    </nav>
    <div class="tab-content border-bottom border-start border-end rounded-bottom ps-5 pt-3 pb-3 pe-5" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-informations" role="tabpanel">
            <?php include 'includes/commande/informations.php'; ?>
        </div>
        <div class="tab-pane fade" id="nav-factures" role="tabpanel">
            <?php include 'includes/commande/factures.php'; ?>
        </div>
    </div>
</div>

</body>
</html>