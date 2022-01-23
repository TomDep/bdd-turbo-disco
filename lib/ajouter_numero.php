<?php

require_once 'connexion.php';
$db = creerConnexion();

$req = "INSERT INTO numerotelephone (id_client, numero) VALUES (". $_POST["id_client"] .", '". $_POST["numero_tel"] ."')";
$db->query($req);

header('Location: ../pages/editer_fiche_client.php?id_client=' . $_POST["id_client"]);