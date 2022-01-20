<?php

require_once 'connexion.php';

$db = creerConnexion();

$req = "INSERT INTO paiement (id_commande, id_type_paiement, montant, date_paiement) 
VALUES (". $_GET["id_commande"] .", ". $_GET["type_paiement"] .", ". $_GET["montant"] .", CURRENT_DATE)";

$result = $db->query($req);

header("Location: ../pages/commande.php?id_commande=". $_GET["id_commande"]);