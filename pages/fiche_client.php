<!DOCTYPE html>
<?php
//paramètres de connexion à la base de données
	$Server="localhost";
	$User="root";
	$Pwd="";
	$DB="entreprise";

	//connexion au serveur où se trouve la base de données
	$db = mysqli_connect($Server, $User, $Pwd, $DB);

	//affichage d’un message d’erreur si la connexion a été refusée
	if (!$db)
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

    $id_client = $_GET["id_client"];
    $client = creerClient($id_client);
    $client->afficher();
?>
</div>

</body>
</html>
