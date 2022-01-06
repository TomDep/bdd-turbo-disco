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
    <title>Ajouter un client</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>


<form action="ajout_client.php" method="POST">
                <h1 >INFO Client</h1>

                <label><b><p >Adresse e-mail</p></b></label>
                <input type="text" placeholder="E-mail..." name="mail" required>

				<label><b><p >Nom</p></b></label>
                <input type="text" placeholder="Nom..." name="nom" required>

				<label><b><p >Prenom</p></b></label>
                <input type="text" placeholder="Prenom..." name="prenom" required>

				<label><b><p >Grade</p></b></label>
                <input type="text" placeholder="Grade..." name="grade" required>

				<label><b><p >Facebook</p></b></label>
                <input type="text" placeholder="Facebook..." name="facebook" required>

                <label><b><p >Instagram</p></b></label>
                <input type="text" placeholder="Instagram..." name="instagram" required>

                <label><b><p >Numero de telephone</p></b></label>
                <input type="text" placeholder="Numero..." name="numero_tel" required>

                <label><b><p >Numero de rue</p></b></label>
                <input type="text" placeholder="Numero de rue..." name="numero_rue" required>

                <label><b><p >Nom de rue</p></b></label>
                <input type="text" placeholder="Nom de rue..." name="nom_rue" required>

                <label><b><p >Ville</p></b></label>
                <input type="text" placeholder="Ville..." name="ville" required>

                <label><b><p >Code Postal</p></b></label>
                <input type="text" placeholder="Code postal..." name="code" required>



                <input type="submit" id='submit' value='Inscrire' >
                            </form>

                <?php



					if(isset($_REQUEST['mail'])){
					$mail=$_REQUEST["mail"];
					$nom=$_REQUEST["nom"];
					$prenom=$_REQUEST["prenom"];
					$grade=$_REQUEST["grade"];
					$facebook=$_REQUEST["facebook"];
					$instagram=$_REQUEST["instagram"];
					$numero_tel=$_REQUEST["numero_tel"];
					$numero_rue=$_REQUEST["numero_rue"];
					$nom_rue=$_REQUEST["nom_rue"];
					$ville=$_REQUEST["ville"];
					$code=$_REQUEST["code"];

					if($mail==""||$grade==""||$facebook==""||$prenom==""||$nom==""){

					}
					else{

					$requete = "INSERT INTO Client (id_grade, nom, prenom,total_depensé,remise_future,adhérent) VALUES ('".$grade."', '".$nom."', '".$prenom."',0,0,0);";
					$Connect->query($requete);
					$requete = "INSERT INTO Adresse (numéro, rue, ville,code_postal,id_client) (SELECT '".$numero_rue."', '".$nom_rue."', '".$ville."','".$code."',id_client FROM Client WHERE nom='".$nom."' AND prenom = '".$prenom."');";
					$Connect->query($requete);
                    $requete = "INSERT INTO Contact (email, instagram, facebook,id_client) (SELECT '".$mail."', '".$instagram."', '".$facebook."',id_client FROM Client WHERE nom='".$nom."' AND prenom = '".$prenom."');";
					$Connect->query($requete);
					$requete = "SELECT * FROM Client WHERE prenom = '".$prenom."' AND nom = '".$nom."' ";
					$reponse = $Connect->query($requete);

					if($ligne = mysqli_fetch_array($reponse)){

						echo "<p id='idPresentation'><font color='green'>Inscription validée</p>";

					}
					else{
						echo "<p id='idPresentation'><font color='red'>erreur</p>";
					}
					}
					}
                ?>

</body>
</html>
