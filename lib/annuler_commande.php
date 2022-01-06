<?php

$id_commande = $_GET['id_commande'];

require_once 'connexion.php';

$connexion = creerConnexion();
$connexion->query("UPDATE ");