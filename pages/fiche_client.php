<?php
require_once '../lib/connexion.php';
require_once '../lib/Utils.php';

$db = creerConnexion();

if(isset($_REQUEST['mail'])&&$_REQUEST['mail']!=""){
    $mail=$_REQUEST["mail"];
    $db->query("UPDATE `contact` SET `email` = '".$mail."' WHERE `id_client` = ".$_GET['id_client']."; ");
}

if(isset($_REQUEST['nom'])&&$_REQUEST['nom']!="") {
    $nom = $_REQUEST["nom"];
    $db->query("UPDATE `client` SET `nom` = '" . $nom . "' WHERE `id_client` = " . $_GET['id_client'] . "; ");
}

if(isset($_REQUEST['prenom'])&&$_REQUEST['prenom']!=""){
    $prenom=$_REQUEST["prenom"];
    $db->query("UPDATE `client` SET `prenom` = '".$prenom."' WHERE `id_client` = ".$_GET['id_client']."; ");
}

if(isset($_REQUEST['facebook'])&&$_REQUEST['facebook']!=""){
    $facebook=$_REQUEST["facebook"];
    $db->query("UPDATE `contact` SET `facebook` = '".$facebook."' WHERE `id_client` = ".$_GET['id_client']."; ");
}

if(isset($_REQUEST['instagram'])&&$_REQUEST['instagram']!=""){
    $instagram=$_REQUEST["instagram"];
    $db->query("UPDATE `contact` SET `instagram` = '".$instagram."' WHERE `id_client` = ".$_GET['id_client']."; ");
}

if(isset($_REQUEST['numero_tel'])&&$_REQUEST['numero_tel']!=""){
    $numero_tel=$_REQUEST["numero_tel"];
    $requete = "INSERT INTO numerotelephone (numero,id_client) VALUES ( '".$numero_tel."',".$_GET['id_client']."); ";
    $db->query($requete);
}

if(isset($_REQUEST['grade'])&&$_REQUEST['grade']!=""){
    $grade=$_REQUEST["grade"];
    $db->query("UPDATE `client` SET `id_grade` = ".$grade." WHERE `id_client` = ".$_GET['id_client']."; ");
}

if(isset($_REQUEST['nom_rue'])&&isset($_REQUEST['ville'])&&isset($_REQUEST['code'])&&isset($_REQUEST['numero_rue'])){
    $nom_rue=$_REQUEST["nom_rue"];
    $ville=$_REQUEST["ville"];
    $code=$_REQUEST["code"];
    $num_rue=$_REQUEST["numero_rue"];

    if($nom_rue!=""&&$ville!=""&&$code!=""&&$num_rue!=""){
        $requete = "INSERT INTO Adresse (numero, rue, ville,code_postal,id_client) VALUES ( '".$num_rue."', '".$nom_rue."', '".$ville."','".$code."',".$_GET['id_client']."); ";
        $db->query($requete);
    }
}

if(isset($_POST['submit'])) {
    $est_adherant = (isset($_REQUEST['adherent']) && $_REQUEST["adherent"] == "on") ? 1 : 0;
    $requete = "UPDATE `client` SET `adherent` = " . $est_adherant . " WHERE `id_client` = " . $_GET['id_client'];
    $db->query($requete);

    $est_vip = (isset($_REQUEST['vip']) && $_REQUEST["vip"] == "on") ? 1 : 0;
    $requete = "UPDATE `client` SET `vip` = " . $est_vip . " WHERE `id_client` = " . $_GET['id_client'];
    $db->query($requete);
}

?>
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

if(!isset($_GET["id_client"])) {
    header("Location: liste_clients.php");
}

    require_once("../lib/Client.php");

    $id_client = $_GET["id_client"];
    $client = creerClient($id_client);

?>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
            <li class="breadcrumb-item"><a href="liste_clients.php">Liste clients</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fiche client</li>
        </ol>
    </nav>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-informations-tab" data-bs-toggle="tab" data-bs-target="#nav-informations" type="button" role="tab">Informations du client</button>
            <button class="nav-link" id="nav-commandes-tab" data-bs-toggle="tab" data-bs-target="#nav-commandes" type="button" role="tab">Commandes</button>
            <button class="nav-link" id="nav-remise-tab" data-bs-toggle="tab" data-bs-target="#nav-remise" type="button" role="tab">Remise</button>
            <button class="nav-link" id="nav-points-tab" data-bs-toggle="tab" data-bs-target="#nav-points" type="button" role="tab">Soldes des points</button>
            <button class="nav-link" id="nav-parametres-tab" data-bs-toggle="tab" data-bs-target="#nav-parametres" type="button" role="tab">Paramètres</button>
        </div>
    </nav>
    <div class="tab-content border-bottom border-start border-end rounded-bottom ps-5 pt-3 pb-3 pe-5" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-informations" role="tabpanel">
            <?php include 'includes/fiche client/informations.php'; ?>
        </div>
        <div class="tab-pane fade" id="nav-commandes" role="tabpanel">
            <?php include 'includes/fiche client/commandes.php'; ?>
        </div>
        <div class="tab-pane fade" id="nav-remise" role="tabpanel">
            <?php include 'includes/fiche client/remise.php'; ?>
        </div>
        <div class="tab-pane fade" id="nav-points" role="tabpanel">
            <?php include 'includes/fiche client/points.php'; ?>
        </div>
        <div class="tab-pane fade" id="nav-parametres" role="tabpanel">
            <?php include 'includes/fiche client/parametres.php'; ?>
        </div>
    </div>

</div>

</body>
</html>
