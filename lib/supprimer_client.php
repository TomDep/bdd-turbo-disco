<?php

require_once "connexion.php";
$db = creerConnexion();

$req  = "DELETE client FROM client WHERE id_client = " . $_GET["id_client"] . ";";
$req .= "DELETE paiement FROM paiement NATURAL JOIN commande WHERE id_client = " . $_GET["id_client"] . ";";
$req .= "DELETE facture FROM facture NATURAL JOIN commande WHERE id_client = " . $_GET["id_client"] . ";";
$req .= "DELETE adresse FROM adresse WHERE id_client = " . $_GET["id_client"] . ";";
$req .= "DELETE numerotelephone FROM numerotelephone WHERE id_client = " . $_GET["id_client"] . ";";
$req .= "DELETE commande FROM commande WHERE id_client = " . $_GET["id_client"] . ";";
$req .= "DELETE soldepoint FROM soldepoint WHERE id_client = " . $_GET["id_client"] . ";";

$db->multi_query($req);

header('Location: ../pages/liste_clients.php');