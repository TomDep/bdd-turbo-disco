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
    <title>Liste des fiches clients</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<?php

require_once "../lib/Client.php";




?>

<div class="container p-5">

    <ul class="list-group">
    <?php
    if(isset($_GET['supprimer'])){

        $Connect->query("DELETE FROM adresse WHERE id_adresse=".$_GET['supprimer']);

    }
    if(isset($_GET['supprimer_num'])){

        $Connect->query("DELETE FROM numerotelephone WHERE numero=".$_GET['supprimer_num']);

    }

    $request = $Connect->query('SELECT * FROM `Client` ');
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
            ?>
            <li class="list-group-item"><?php $client->afficherApercu(); ?></li><?php

            }
    ?>
    </ul>
</div>

</body>
</html>
