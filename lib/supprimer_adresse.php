<?php

require_once 'connexion.php';
$db = creerConnexion();

$req = "DELETE FROM adresse WHERE id_adresse = " . $_GET["id_adresse"];
$db->query($req);

header('Location: ../pages/editer_fiche_client.php?id_client=' . $_GET["id_client"]);