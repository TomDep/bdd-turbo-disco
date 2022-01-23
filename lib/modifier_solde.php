<?php

require_once 'connexion.php';
$db = creerConnexion();

$id_solde = $_GET["id_solde"];
$montant = $_GET["montant"];

$req = "UPDATE soldepoint SET quantite = quantite + " . $montant . " WHERE id_solde_point = " . $id_solde;
$result = $db->query($req);

if(!$result) {
    echo '<p>Erreur : ' . $db->error . '</p>';
} else {
    header('Location: ../pages/fiche_client.php?id_client=' . $_GET["id_client"]);
}