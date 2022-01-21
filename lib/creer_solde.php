<?php

$intitule = $_GET["intitule"];
$quantite = $_GET["quantite"];
$id_client = $_GET["id_client"];

require_once 'connexion.php';

$db = creerConnexion();
$req = "INSERT INTO soldepoint (id_client, id_valeur_point, date_expiration, quantite, intitule) VALUES (" .
    $id_client .", 1, '2100-01-01', ". $quantite .", '". $intitule ."')";

$db->query($req);
echo $db->error;

//header('Location: ../pages/fiche_client.php?id_client=' . $id_client);