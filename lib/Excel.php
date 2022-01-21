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



$request = $Connect->query('SELECT id_commande,  nom, prenom, intitule_paiement, date_passage, date_validation, prix_total FROM Commande natural join client natural join statuscommande');

if( file_exists ( "Commandes.csv"))
    unlink( "Commandes.csv" ) ;
$file = fopen("Commandes.csv", "a");
fwrite($file,"Id commande ; Nom client ; Prenom client ; Intitule paiement ; Date de passage ;  Date de validation ; Prix total \n");
var_dump($request);
while($ligne1 = mysqli_fetch_array($request)){

    for ($i=0;$i<7;$i++){
        if ($i<6){
            fwrite($file,$ligne1[$i].'; ');
        }

        else if ($i==6) {
            fwrite($file,$ligne1[6]);
            fputs($file,"\n");
        }
    }


}

//header("Location: http://localhost/bdd-turbo-disco/pages/liste_commandes.php")
?>