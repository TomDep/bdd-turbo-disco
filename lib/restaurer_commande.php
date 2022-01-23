<?php

require_once 'connexion.php';
$db = creerConnexion();

$req = "UPDATE commande SET id_status_commande = 4, date_passage = CURRENT_DATE, date_validation = NULL, date_cloture = NULL WHERE id_commande = " . $_GET["id_commande"];
$result = $db->query($req);

if(!$result) {
    echo '<p>Erreur : ' . $db->error . '</p>';
} else {
    header('Location: ../pages/commande.php?id_commande=' . $_GET["id_commande"]);
}