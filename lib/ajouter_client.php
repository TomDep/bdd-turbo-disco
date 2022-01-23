<?php

require_once 'connexion.php';
$db = creerConnexion();

$grade = $_POST["grade"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$adherent = isset($_POST["adherent"]) ? "true" : "false";

// Ajout du client
$req = "INSERT INTO client (id_grade, nom, prenom, remise_future, adherent) VALUES (" . $grade .", '". $nom ."', '". $prenom ."', 0, ". $adherent .")";
$db->query($req);

// Récupération de l'id du client
$req = "SELECT LAST_INSERT_ID()";
$result = $db->query($req);
$id_client = $result->fetch_all()[0][0];

// Ajout de l'adresse
$numero = $_POST["numero"];
$rue = $_POST["rue"];
$ville = $_POST["ville"];
$code_postal = $_POST["code_postal"];

$req = "INSERT INTO adresse (id_client, numero, rue, ville, code_postal) VALUES (". $id_client .", ". $numero .", '". $rue ."', '". $ville ."', ". $code_postal .")";
$db->query($req);

// Ajout du contact
$email = $_POST["email"];
$instagram = $_POST["instagram"];
$facebook = $_POST["facebook"];

$req = "INSERT INTO contact (id_client, email, instagram, facebook) VALUES (". $id_client .", '". $email ."', '". $instagram ."', '". $facebook ."')";
$db->query($req);

// Ajout du numero de telephone
$numero_tel = $_POST["numero_tel"];

$req = "INSERT INTO numerotelephone (id_client, numero) VALUES (". $id_client .", '". $numero_tel ."')";
$db->query($req);

echo $db->error;

// Création d'un solde de fidélité
$req = "INSERT INTO soldepoint SET (id_client, id_valeur_point, date_expiration, quantite, intitule) VALUES (?, 1, NULL, 0, 'Fidélité')";
$stmt = $db->prepare($req);
$stmt->bind_param("i", $id_client);
$stmt->execute();

header("Location: ../pages/fiche_client.php?id_client=" . $id_client);