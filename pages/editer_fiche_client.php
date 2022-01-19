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
    <title>Éditer une fiche client</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5">
<?php

require_once("../lib/Client.php");

    if(isset($_REQUEST['mail'])&&$_REQUEST['mail']!=""){
        $mail=$_REQUEST["mail"];
        $Connect->query("UPDATE `contact` SET `email` = '".$mail."' WHERE `id_client` = ".$_GET['id']."; ");

    }
    if(isset($_REQUEST['nom'])&&$_REQUEST['nom']!=""){
        $nom=$_REQUEST["nom"];
        $Connect->query("UPDATE `client` SET `nom` = '".$nom."' WHERE `id_client` = ".$_GET['id']."; ");
    }
    if(isset($_REQUEST['prenom'])&&$_REQUEST['prenom']!=""){
        $prenom=$_REQUEST["prenom"];
        $Connect->query("UPDATE `client` SET `prenom` = '".$prenom."' WHERE `id_client` = ".$_GET['id']."; ");
    }
    if(isset($_REQUEST['facebook'])&&$_REQUEST['facebook']!=""){
       $facebook=$_REQUEST["facebook"];
        $Connect->query("UPDATE `contact` SET `facebook` = '".$facebook."' WHERE `id_client` = ".$_GET['id']."; ");
    }
    if(isset($_REQUEST['instagram'])&&$_REQUEST['instagram']!=""){
        $instagram=$_REQUEST["instagram"];
        $Connect->query("UPDATE `contact` SET `instagram` = '".$instagram."' WHERE `id_client` = ".$_GET['id']."; ");
    }
    if(isset($_REQUEST['numero_tel'])&&$_REQUEST['numero_tel']!=""){
        $numero_tel=$_REQUEST["numero_tel"];
        $requete = "INSERT INTO numerotelephone (numero,id_client) VALUES ( '".$numero_tel."',".$_GET['id']."); ";
        $Connect->query($requete);
    }
    if(isset($_REQUEST['grade'])&&$_REQUEST['grade']!=""){
        $grade=$_REQUEST["grade"];
        $Connect->query("UPDATE `client` SET `id_grade` = ".$grade." WHERE `id_client` = ".$_GET['id']."; ");
    }

    if(isset($_REQUEST['nom_rue'])&&isset($_REQUEST['ville'])&&isset($_REQUEST['code'])&&isset($_REQUEST['numero_rue'])){
        $nom_rue=$_REQUEST["nom_rue"];
        $ville=$_REQUEST["ville"];
        $code=$_REQUEST["code"];
        $num_rue=$_REQUEST["numero_rue"];
        if($nom_rue!=""&&$ville!=""&&$code!=""&&$num_rue!=""){
            $requete = "INSERT INTO Adresse (numero, rue, ville,code_postal,id_client) VALUES ( '".$num_rue."', '".$nom_rue."', '".$ville."','".$code."',".$_GET['id']."); ";
            $Connect->query($requete);
        }
    }

    $id_client = $_GET["id_client"];
    $client = creerClient($id_client);
    $client->afficher_edition();

   ?>
   <form action="editer_fiche_client.php?id_client=<?php echo $_GET['id'] ; ?>" method="POST">
       <h1 >INFO Client</h1>

                <label><b><p >Adresse e-mail</p></b></label>
                <input type="text" placeholder="E-mail..." name="mail" >

				<label><b><p >Nom</p></b></label>
                <input type="text" placeholder="Nom..." name="nom" >

				<label><b><p >Prenom</p></b></label>
                <input type="text" placeholder="Prenom..." name="prenom" >

				<label><b><p >Grade</p></b></label>
                <input type="text" placeholder="Grade..." name="grade" >

				<label><b><p >Facebook</p></b></label>
                <input type="text" placeholder="Facebook..." name="facebook" >

                <label><b><p >Instagram</p></b></label>
                <input type="text" placeholder="Instagram..." name="instagram" >

                <label><b><p >Ajouter numero de telephone</p></b></label>
                <input type="text" placeholder="Numero..." name="numero_tel" >

                <input type='submit' id='submit'  value='Appliquer les modifications' >

                <h1 >Ajouter Adresse</h1>
                <label><b><p >Numero de rue</p></b></label>
                <input type="text" placeholder="Numero de rue..." name="numero_rue" >

                <label><b><p >Nom de rue</p></b></label>
                <input type="text" placeholder="Nom de rue..." name="nom_rue" >

                <label><b><p >Ville</p></b></label>
                <input type="text" placeholder="Ville..." name="ville" >

                <label><b><p >Code Postal</p></b></label>
                <input type="text" placeholder="Code postal..." name="code" >



                <input type='submit'  id='submit' value='Ajouter adresse' >
                            </form>


</div>


</body>
</html>
