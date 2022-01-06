<?php

function creerConnexion()
{
    //paramètres de connexion à la base de données
    $Server="localhost";
    $User="root";
    $Pwd="";
    $DB="entreprise";

    //connexion au serveur où se trouve la base de données
    $connexion = mysqli_connect($Server, $User, $Pwd, $DB);

    //affichage d’un message d’erreur si la connexion a été refusée
    if (!$connexion)
        echo "Connexion à la base impossible";

    return $connexion;
}
