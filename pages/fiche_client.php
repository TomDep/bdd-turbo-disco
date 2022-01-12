<!DOCTYPE html>
<?php
//paramètres de connexion à la base de données
	$Server="localhost";
	$User="root";
	$Pwd="";
	$DB="entreprise";

	//connexion au serveur où se trouve la base de données
	$Connect = mysqli_connect($Server, $User, $Pwd, $DB);

	//affichage d’un message d’erreur si la connexion a été refusée
	if (!$Connect)
		echo "Connexion à la base impossible";


    session_start();

		//print_r($reponse);
?>
<html lang="fr">
<head>
    <title>Fiche client</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5">
<?php

require_once("../lib/Client.php");



    $request = $Connect->query("SELECT * FROM `Client` WHERE id_client=".$_GET['id']);
	while($ligne = mysqli_fetch_array($request)){
        $grade=mysqli_fetch_array($Connect->query("SELECT intitule_grade FROM Grade WHERE id_grade=".$ligne["id_grade"].""));

        $facebook=mysqli_fetch_array($Connect->query("SELECT facebook FROM Contact WHERE id_client=".$ligne["id_client"].""));
        $instagram=mysqli_fetch_array($Connect->query("SELECT instagram FROM Contact WHERE id_client=".$ligne["id_client"].""));
        $mail=mysqli_fetch_array($Connect->query("SELECT email FROM Contact WHERE id_client=".$ligne["id_client"].""));
        $numero_tel=mysqli_fetch_array($Connect->query("SELECT numero FROM numerotelephone WHERE id_client=".$ligne["id_client"].""));
        $client = new Client(
            $ligne["id_client"],
            $ligne["nom"],
            $ligne["prenom"],
            $grade[0],
            $facebook[0],
            $instagram[0],
            $mail[0],
            $ligne["total_depense"],
            $ligne["remise_future"],
            $ligne["adherent"],
            $numero_tel[0]);


            }

    $request = $Connect->query("SELECT * FROM `adresse` WHERE id_client=".$_GET['id']);
    while($ligne = mysqli_fetch_array($request)){
            $num_rue=mysqli_fetch_array($Connect->query("SELECT numero FROM adresse  WHERE id_adresse=".$ligne["id_adresse"]));
            $nom_rue=mysqli_fetch_array($Connect->query("SELECT rue FROM adresse  WHERE id_adresse=".$ligne["id_adresse"]));
            $code=mysqli_fetch_array($Connect->query("SELECT code_postal FROM adresse  WHERE id_adresse=".$ligne["id_adresse"]));
            $ville=mysqli_fetch_array($Connect->query("SELECT ville FROM adresse  WHERE id_adresse=".$ligne["id_adresse"]));
            $client->ajouterAdresse(new Adresse($num_rue[0], $nom_rue[0], $code[0], $ville[0]));

    }
    $request = $Connect->query("SELECT * FROM `numerotelephone` WHERE id_client=".$_GET['id']);
    while($ligne = mysqli_fetch_array($request)){
        $num=mysqli_fetch_array($Connect->query("SELECT numero FROM numerotelephone WHERE id_numero_telephone=".$ligne["id_numero_telephone"]));
        $client->ajouterNumeroTelephone($num[0]);
    }



$client->afficher();
?>
</div>

</body>
</html>
