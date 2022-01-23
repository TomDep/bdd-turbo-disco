<?php

require_once 'Commande.php';
require_once 'connexion.php';

$id_commande = $_GET['id_commande'];
$statut_actuel = $_GET['statut_actuel'];

$connexion = creerConnexion();

switch ($statut_actuel) {
    case StatutCommande::attente_validation:
        $connexion->query("UPDATE commande SET id_status_commande = 1, date_validation = CURRENT_DATE WHERE id_commande = " . $id_commande);
        break;
    case StatutCommande::en_cours:
        $connexion->query("UPDATE commande SET id_status_commande = 2, date_cloture = CURRENT_DATE WHERE id_commande = " . $id_commande);
        break;
}
header("location: ../pages/commande.php?id_commande=" . $id_commande);