<?php

require_once 'connexion.php';

$db = creerConnexion();

$req = "INSERT INTO paiement (id_commande, id_type_paiement, montant, date_paiement) 
VALUES (". $_GET["id_commande"] .", ". $_GET["type_paiement"] .", ". $_GET["montant"] .", CURRENT_DATE)";

$result = $db->query($req);

$req = "UPDATE commande SET acompte = LAST_INSERT_ID() WHERE id_commande = " . $_GET["id_commande"];
$db->query($req);

$req2="SELECT montant FROM paiement WHERE id_commande=". $_GET["id_commande"];
$result2 = $db->query($req2);
$total_paiement=0;
while($ligne=mysqli_fetch_array($result2)){
    $total_paiement+=$ligne['montant'];
}
$ligne2=mysqli_fetch_array($db->query("SELECT prix_total FROM commande WHERE id_commande=".$_GET['id_commande']));
if($ligne2['prix_total']<=$total_paiement){
    $db->query("UPDATE commande SET est_payee = 1 WHERE id_commande = " . $_GET["id_commande"]);
}



header("Location: ../pages/commande.php?id_commande=". $_GET["id_commande"]);