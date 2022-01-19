<?php

$id_commande = $_GET['id_commande'];

require_once 'connexion.php';

$connexion = creerConnexion();
$connexion->query("UPDATE commande SET id_status_commande = 3 WHERE id_commande = " . $id_commande);

header("location: ../pages/liste_commandes");