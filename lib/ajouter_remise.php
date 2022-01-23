<?php

require_once 'connexion.php';
$db = creerConnexion();

$req = "UPDATE client SET remise_future = " . $_GET["montant"] . " WHERE id_client = " . $_GET["id_client"];
$result = $db->query($req);

if(!$result) {
    echo '<p>Erreur : ' . $db->error . '</p>';
} else {
    header('Location: ../pages/fiche_client.php?id_client=' . $_GET["id_client"]);
}