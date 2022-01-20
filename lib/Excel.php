<?php
echo ("oui");

//param�tres de connexion � la base de donn�es
$Server="localhost";
$User="root";
$Pwd="";
$DB="entreprise";

//connexion au serveur o� se trouve la base de donn�es
$Connect = mysqli_connect($Server, $User, $Pwd, $DB);

//affichage d�un message d�erreur si la connexion a �t� refus�e
if (!$Connect)
    echo "Connexion � la base impossible";


session_start();


$request2 = $Connect->query('SELECT * FROM Commande ');
if( file_exists ( "Commandes.csv"))
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
?>