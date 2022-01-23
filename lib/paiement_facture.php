<?php

require_once 'ArticleCommande.php';
require_once 'Facture.php';
require_once 'Point.php';
require_once 'Client.php';
require_once 'Commande.php';

session_start();

require_once 'connexion.php';
$db = creerConnexion();

$facture = $_SESSION["facture"];
$total_a_payer = $facture->totalTTC();

$client = creerClient($facture->id_client);
$remise = $client->remise_future + $facture->remise;

if($remise > 0) {
    echo '<p>Remise de '. $remise .'</p>';

    if($remise > $total_a_payer) {
        $total_a_payer = 0;

        $req = "UPDATE client SET remise_future = remise_future - " . $total_a_payer . " WHERE id_client = " . $client->id;
        $db->query();
    } else {
        $total_a_payer -= $client->remise_future;
        $req = "UPDATE client SET remise_future = 0 WHERE id_client = " . $client->id;
        $db->query($req);
    }
}

$total_points = 0;
if(isset($_GET["id_solde"]) && $total_a_payer > 0) {
    $point = creerPoint($_GET["id_solde"]);
    $argent_points = recupererValeurPoint() * $point->quantite;

    echo '<p>#'. $point->id_solde .' Le client dispose de ' . $point->quantite . ' points d\'une valeur de '. $argent_points . ' €</p>';

    if($argent_points > $total_a_payer) {
        // On enlève les points correspondant
        $nb_a_elenver = $total_a_payer / recupererValeurPoint();
        $total_points = $total_a_payer;

        $req = "UPDATE soldepoint SET quantite = quantite - " . $nb_a_elenver . " WHERE id_solde_point = " . $point->id_solde;
        $db->query($req);

        $total_a_payer = 0;

        echo '<p>Il ne reste plus rien a payé en dehors des points</p>';
    } else {
        $total_a_payer -= $argent_points;
        $total_points = $argent_points;

        echo '<p>Il reste ' . $total_a_payer . ' € a payer</p>';

        // Si le solde n'est pas le solde de fidélité alors on le supprime
        if($point->intitule != "Fidélité") {
            echo '<p>Suppression du solde</p>';
            $req = "DELETE FROM soldepoint WHERE id_solde_point = " . $point->id_solde;
            $db->query($req);
        } else {
            echo '<p>Mise à zero du solde</p>';
            $req = "UPDATE soldepoint SET quantite = 0 WHERE id_solde_point = " . $point->id_solde;
            $db->query($req);
        }
    }
}

// Création de la facture
$req = "INSERT INTO facture (id_commande, date_facturation, frais_service, frais_livraison, remise)
    VALUES (". $facture->id_commande .", CURRENT_DATE, ". $facture->frais_service .
    ", ". $facture->frais_livraison .", ". min($remise, $total_a_payer) .")";
$db->query($req);

// Récupération de l'ID de la facture
$req = "SELECT LAST_INSERT_ID()";
$result = $db->query($req);
$facture->id = $result->fetch_all()[0][0];

// Créer un paiement pour un mode de paiement classique
if($total_a_payer > 0) {
    echo "<p>Création d'un paiement normal de " . $total_a_payer . ' €</p>';

    $req = "INSERT INTO paiement (id_commande, id_facture, id_type_paiement, montant, date_paiement) VALUES (
        " . $facture->id_commande . ", " . $facture->id . ", " . $_GET["type_paiement"] . ", " . $total_a_payer . ", CURRENT_DATE)";
    $db->query($req);
}

// Créer un paiement pour les points
if($total_points > 0) {
    echo "<p>Création d'un paiement par points de " . $total_points . ' €</p>';

    $req = "INSERT INTO paiement (id_commande, id_facture, id_type_paiement, montant, date_paiement) VALUES (
        ". $facture->id_commande .", ". $facture->id .", 4, ". $total_points .", CURRENT_DATE)";
    $db->query($req);
}

// Ajout des points de fidélité si la personnes est adherent
if($client->adherant) {
    echo '<p>Ajout de ' . $total_a_payer . ' points de fidélité</p>';
    $req = "UPDATE soldepoint SET quantite = quantite + " . $total_a_payer . " WHERE id_client = " . $client->id . " AND intitule = 'Fidélité'";
    $db->query($req);
}

// Modification du status des articles de la facture
foreach ($facture->articles as $article) {
    $req = "UPDATE itemcommande SET id_facture = ". $facture->id ." WHERE id_commande = " . $facture->id_commande . " AND id_article = " . $article->id;
    $db->query($req);
}

if($db->error != "") {
    echo "<p>Erreur : ". $db->error ."</p>";
} else {
    header("Location: ../pages/commande.php?id_commande=" . $facture->id_commande);
}
