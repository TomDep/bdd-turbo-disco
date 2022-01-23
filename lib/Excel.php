<?php

require_once 'connexion.php';
require_once 'Commande.php';

$db = creerConnexion();
$request = $db->query('SELECT id_commande, nom, prenom, intitule_status_commande, date_passage, date_validation, date_cloture FROM Commande natural join client natural join statuscommande');

if(file_exists ( "Commandes.csv")) unlink( "Commandes.csv" ) ;

$file = fopen("Commandes.csv", "a");
fwrite($file,"Id commande ; Nom ; Prenom ; Status commande ; Date de passage ;  Date de validation ; Date de cloture ; Prix total \n");

while($commande = $request->fetch_assoc()){

    fwrite($file, $commande["id_commande"] . ' ; ');
    fwrite($file, $commande["nom"] . ' ; ');
    fwrite($file, $commande["prenom"] . ' ; ');
    fwrite($file, $commande["intitule_status_commande"] . ' ; ');
    fwrite($file, $commande["date_passage"] . ' ; ');
    fwrite($file, $commande["date_validation"] . ' ; ');
    fwrite($file, $commande["date_cloture"] . ' ; ');

    // Récupération du prix total
    $commande_obj = creerCommande($commande["id_commande"]);

    fwrite($file, $commande_obj->calculerPrixTotal() . "\n");
}

include 'Commandes.csv';

header('Content-Description: File Transfer');
header("Content-Type: application/csv") ;
header("Content-Disposition: attachment; filename=download.csv");
header("Pragma: no-cache");
header("Expires: 0");


