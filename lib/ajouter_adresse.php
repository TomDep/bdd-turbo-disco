<?php

require_once 'connexion.php';
$db = creerConnexion();

$req = "INSERT INTO adresse (id_client, numero, rue, ville, code_postal) VALUES (". $_GET["id_client"] .", ".
    $_GET["numero"] .", '". $_GET["rue"] ."', '". $_GET["ville"] ."', ". $_GET["code_postal"] .")";
$db->query($req);

header('Location: ../pages/editer_fiche_client.php?id_client=' . $_GET["id_client"]);