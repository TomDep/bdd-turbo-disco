<?php

$id_commande = $_GET['id_commande'];

require_once 'connexion.php';

$connexion = creerConnexion();
$connexion->query("UPDATE commande SET id_status_commande = 3, date_cloture = CURRENT_DATE WHERE id_commande = " . $id_commande);

header("location: ../pages/commande.php?id_commande=" . $id_commande);