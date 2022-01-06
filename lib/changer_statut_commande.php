<?php

require_once 'Commande.php';
require_once 'connexion.php';

$id_commande = $_GET['id_commande'];
$statut_actuel = $_GET['statut_actuel'];

$connexion = creerConnexion();

switch ($statut_actuel) {
    case StatutCommande::attente_validation:
        $connexion->query("UPDATE commande SET id_status_commande = 1 WHERE id_commande = " . $id_commande);
        break;
    case StatutCommande::en_cours:
        $connexion->query("UPDATE commande SET id_status_commande = 2 WHERE id_commande = " . $id_commande);
        break;
    case StatutCommande::livree:
        $connexion->query("UPDATE commande SET id_status_commande = 3 WHERE id_commande = " . $id_commande);
        break;
}