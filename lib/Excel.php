<?php

require_once "connexion.php";
$db = creerConnexion();

$request2 = $db->query('SELECT * FROM Commande ');
if(file_exists ( "Commandes.csv"))
    unlink( "Commandes.csv" ) ;
$file = fopen("Commandes.csv", "a");
fwrite($file,"Id commande ; Id Status Commande ; Id Client ; Date de passage ; Date de validation ; Date d'arrivée ; Prix total \n");

while($ligne1 = mysqli_fetch_array($request2)){


    for ($i=0;$i<7;$i++){
        if ($i<6){
            fwrite($file,$ligne1[$i].'; ');
        }
        else {
            fwrite($file,$ligne1[6]);
            fputs($file,"\n");
        }
    }

}

header("location: ../pages/liste_commandes");
