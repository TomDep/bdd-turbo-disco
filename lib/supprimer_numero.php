<?php

require_once 'connexion.php';
$db = creerConnexion();

$req = "DELETE FROM numerotelephone WHERE id_numero_telephone = " . $_GET["id_numero"];
$db->query($req);

header('Location: ../pages/editer_fiche_client.php?id_client=' . $_GET["id_client"]);