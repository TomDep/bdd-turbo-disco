<?php
require_once '../lib/connexion.php';
$db = creerConnexion();

if(isset($_REQUEST['mail'])&&$_REQUEST['mail']!=""){
    $mail=$_REQUEST["mail"];
    $db->query("UPDATE `contact` SET `email` = '".$mail."' WHERE `id_client` = ".$_GET['id_client']."; ");
}

if(isset($_REQUEST['nom'])&&$_REQUEST['nom']!=""){
    $nom=$_REQUEST["nom"];
    $db->query("UPDATE `client` SET `nom` = '".$nom."' WHERE `id_client` = ".$_GET['id_client']."; ");
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

$est_adherant = (isset($_REQUEST['adherent']) && $_REQUEST["adherent"] == "on") ? 1 : 0;
$requete = "UPDATE `client` SET `adherent` = ".$est_adherant." WHERE `id_client` = ".$_GET['id_client'];
$db->query($requete);

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

    require_once("../lib/Client.php");

    $id_client = $_GET["id_client"];
    $client = creerClient($id_client);

?>
    <div class="container border rounded">
        <div class="ps-5 pt-3">
            <h2>
                <?php echo $client->prenom . ' ' . $client->nom; ?>
            </h2>
            <p class="pb-2">
                Client  <?php echo $client->grade; ?>
            </p>

            <a class="btn btn-outline-primary" href="editer_fiche_client.php?id_client=<?php echo $client->id; ?>">
                <i class="bi bi-pencil me-2"></i>
                Editer la fiche
            </a>
        </div>

        <hr>

        <div>
            <div class="row gx-5">
                <div class="col">
                    <h4 class="ps-5 mt-2">Contact</h4>
                    <ul class="list-group-flush">
                        <li class="list-group-item"><i class="bi bi-envelope me-3"></i><?php echo $client->email; ?></li>
                        <li class="list-group-item"><i class="bi bi-facebook me-3"></i><?php echo $client->facebook; ?></li>
                        <li class="list-group-item"><i class="bi bi-instagram me-3"></i><?php echo $client->instagram; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="ps-5 mt-2">
                        <?php echo (count($client->adresses) == 1) ? "Adresse" : "Adresses"; ?>
                    </h4>
                    <ul class="list-group-flush">
                        <?php foreach ($client->adresses as $adresse) {?>
                            <li class="list-group-item">
                                <?php echo
                                    $adresse->numero . ' '
                                    . $adresse->rue . ', '
                                    . $adresse->codePostal . ' '
                                    . $adresse->ville; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="ps-5 mt-2">
                        <?php echo "Numéro" . ((count($client->numerosTel) == 1) ? " de téléphone" : "s de téléphone"); ?>
                    </h4>
                    <ul class="list-group-flush">
                        <?php foreach ($client->numerosTel as $numero) {?>
                            <li class="list-group-item">
                                <i class="bi bi-telephone me-3"></i><?php echo $numero->numero; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <h4 class="ps-5">Informations</h4>
                    <ul class="list-group-flush">
                        <li class="list-group-item">Montant dépensé : <?php echo $client->total_depense; ?> €</li>
                        <li class="list-group-item">Remise future : <?php echo $client->remise_future; ?> €</li>
                        <li class="list-group-item">Adhérant : <?php echo ($client->adhérant) ? "Oui" : "Non"; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>

</div>

</body>
</html>
