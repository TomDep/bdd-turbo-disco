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

    $query = "SELECT 
       id_client, 
       nom, 
       prenom, 
       intitule_grade, 
       facebook, 
       instagram, 
       email, 
       total_depense, 
       remise_future, 
       adherent 
        FROM client NATURAL JOIN contact NATURAL JOIN numerotelephone NATURAL JOIN grade";
    $request = $Connect->query($query);
    if($request) {
        while($resultat = mysqli_fetch_array($request)){

            $client = new Client(
                $resultat["id_client"],
                $resultat["nom"],
                $resultat["prenom"],
                $resultat["intitule_grade"],
                $resultat["facebook"],
                $resultat["instagram"],
                $resultat["email"],
                $resultat["total_depense"],
                $resultat["remise_future"],
                $resultat["adherent"])

                ?>
                <li class="list-group-item"><?php $client->afficherApercu(); ?></li><?php

                }
        } else {
            echo '<p class="text-danger">' . $Connect->error . '</p>';
        }
    ?>
    </ul>
</div>

</body>
</html>
