<?php

function creerClient($id_client) {

    $query = "SELECT
       nom, 
       prenom, 
       intitule_grade, 
       facebook, 
       instagram, 
       email,
       remise_future, 
       adherent 
        FROM client NATURAL JOIN contact NATURAL JOIN numerotelephone NATURAL JOIN grade WHERE id_client = " . $id_client;

    include_once 'connexion.php';

    $db = creerConnexion();
    $requeteClient = $db->query($query);
    if($requeteClient) {
        while($client = mysqli_fetch_array($requeteClient)){

            $clientObj = new Client(
                $id_client,
                $client["nom"],
                $client["prenom"],
                $client["intitule_grade"],
                $client["facebook"],
                $client["instagram"],
                $client["email"],
                $client["remise_future"],
                $client["adherent"]);

            // Ajout des adresses
            //echo "<p>Récupération des adresses</p>";
            $clientObj->recupererAdresses($db);

            // Ajout des numéros de téléphones
            //echo "<p>Récupération des numéros de téléphones</p>";
            $clientObj->recupererNumeros($db);

            return $clientObj;
        }
    } else {
        echo '<p class="text-danger">' . $db->error . '</p>';
        return -1;
    }

    return -1;
}

function creerListeClients() {
    $clients = [];

    $query = "SELECT 
       id_client, 
       nom, 
       prenom, 
       intitule_grade, 
       facebook, 
       instagram, 
       email,
       remise_future, 
       adherent 
        FROM client NATURAL JOIN contact NATURAL JOIN numerotelephone NATURAL JOIN grade";

    include_once 'connexion.php';

    $db = creerConnexion();
    $requeteClient = $db->query($query);
    if($requeteClient) {
        while($client = mysqli_fetch_array($requeteClient)){

            //echo "<p>Récupération des informations du clients</p>";

            $clientObj = new Client(
                $client["id_client"],
                $client["nom"],
                $client["prenom"],
                $client["intitule_grade"],
                $client["facebook"],
                $client["instagram"],
                $client["email"],
                $client["remise_future"],
                $client["adherent"]);

            // Ajout des adresses
            //echo "<p>Récupération des adresses</p>";
            $clientObj->recupererAdresses($db);

            // Ajout des numéros de téléphones
            //echo "<p>Récupération des numéros de téléphones</p>";
            $clientObj->recupererNumeros($db);

            $clients[] = $clientObj;
        }
    } else {
        echo '<p class="text-danger">' . $db->error . '</p>';
        return -1;
    }

    //echo "<p>Fin</p>";
    return $clients;
}

class NumeroTelephone
{
    public $id;
    public $numero;

    public function __construct($id, $numero) {
        $this->id = $id;
        $this->numero = $numero;
    }
}

class Adresse
{
    public $numero;
    public $rue;
    public $ville;
    public $codePostal;
    public $id;

    public function __construct($id, $numero, $rue, $codePostal, $ville)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
    }

    public function afficher() {

    }
}

class Client
{
    public $nom;
    public $prenom;
    public $grade;
    public $total_depense;
    public $remise_future;
    public $adhérant;
    public $id;

    // Adresses
    public $adresses=[];

    // Numéros
    public $numerosTel=[];

    // Contact
    public $facebook;
    public $instagram;
    public $email;

    public function __construct($id, $nom, $prenom, $grade, $facebook, $instagram, $email, $remise_future, $adhérant)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->grade = $grade;
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->email = $email;
        $this->remise_future=$remise_future;
        $this->adhérant=$adhérant;

        $db = creerConnexion();

        // Récupérer le montant total
        $req = "SELECT SUM(montant) AS total FROM paiement NATURAL JOIN commande WHERE id_client = " . $id . " GROUP BY id_client";
        $response = $db->query($req);

        if(!$response) {
            echo '<p>Erreur : ' . $db->error . '</p>';
        } else {
            while($paiement = $response->fetch_assoc()) {
                $this->total_depense = $paiement["total"];
            }
        }

        // Récupérer si il
    }

    public function recupererNumeros($db) {
        $reqTelephone = "SELECT id_numero_telephone, numero FROM numerotelephone WHERE id_client = " . $this->id;

        if($reponseTelephones = $db->query($reqTelephone)) {
            while ($numero = $reponseTelephones->fetch_assoc()) {
                $numeroObj = new NumeroTelephone($numero["id_numero_telephone"], $numero["numero"]);
                $this->ajouterNumeroTelephone($numeroObj);
            }
        } else {
            echo '<p class="text-danger">Erreur : '. $db->error .'</p>';
        }
    }

    public function ajouterNumeroTelephone($numero) {
        $this->numerosTel[] = $numero;
    }

    public function recupererAdresses($db) {
        $reqAdresse = "SELECT id_adresse, numero, rue, ville, code_postal FROM adresse WHERE id_client = " . $this->id;
        if($reponseAdresses = $db->query($reqAdresse)) {
            while ($adresse = $reponseAdresses->fetch_assoc()) {
                $adresseObj = new Adresse($adresse["id_adresse"], $adresse["numero"], $adresse["rue"], $adresse["code_postal"], $adresse["ville"]);
                $this->ajouterAdresse($adresseObj);
            }
        } else {
            echo '<p class="text-danger">Erreur : '. $db->error .'</p>';
        }
    }

    public function ajouterAdresse($adresse) {
        $this->adresses[] = $adresse;
    }

    public function afficherApercu() {
        ?>
        <div class="row">
            <div class="col-3">
                <span><?php echo $this->getNomPrenom(); ?></span>
            </div>

            <div class="col-3">
                <span>Adhérant : <?php echo $this->adhérant; ?> </span>
            </div>
            <div class="col-1">
                <span><?php echo $this->grade; ?></span>
            </div>

            <div class="col">
                <a class="float-end" href="fiche_client.php?id_client=<?php echo $this->id; ?>">Voir la fiche</a>
            </div>
        </div>
        <?php
    }

    public function getNomPrenom() {
        return $this->nom . " " . $this->prenom;
    }
}
