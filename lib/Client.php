<?php

function creerClient($id_client) {

    $query = "SELECT
       nom, 
       prenom, 
       intitule_grade, 
       facebook, 
       instagram, 
       email, 
       total_depense, 
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
                $client["total_depense"],
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
       total_depense, 
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
                $client["total_depense"],
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
    private $nom;
    private $prenom;
    private $grade;
    private $total_depensé;
    private $remise_future;
    private $adhérant;
    private $totalDepense;
    private $id;

    // Adresses
    private $adresses=[];

    // Numéros
    private $numerosTel=[];

    // Contact
    private $facebook;
    private $instagram;
    private $email;

    public function __construct($id, $nom, $prenom, $grade, $facebook, $instagram, $email, $total_depensé, $remise_future, $adhérant)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->grade = $grade;
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->email = $email;
        $this->totalDepense=$total_depensé;
        $this->remise_future=$remise_future;
        $this->adhérant=$adhérant;

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


     private function afficherContact(){
        ?>
        <h4 class="ps-5 mt-2">Contact</h4>
        <ul class="list-group-flush">
            <li class="list-group-item"><i class="bi bi-envelope me-3"></i><?php echo $this->email; ?></li>
            <li class="list-group-item"><i class="bi bi-facebook me-3"></i><?php echo $this->facebook; ?></li>
            <li class="list-group-item"><i class="bi bi-instagram me-3"></i><?php echo $this->instagram; ?></li>
        </ul>
        <?php
    }


    private function afficherAdresse() {
        ?>
        <h4 class="ps-5 mt-2">
            <?php echo (count($this->adresses) == 1) ? "Adresse" : "Adresses"; ?>
        </h4>
        <ul class="list-group-flush">
            <?php foreach ($this->adresses as $adresse) {?>
                <li class="list-group-item">
                    <?php echo
                        $adresse->numero . ' '
                        . $adresse->rue . ', '
                        . $adresse->codePostal . ' '
                        . $adresse->ville; ?>
                </li>


            <?php

                    } ?>
        </ul>
        <?php
    }

    private function afficherNumero() {
        ?>
        <h4 class="ps-5 mt-2">
            <?php echo "Numéro" . ((count($this->numerosTel) == 1) ? " de téléphone" : "s de téléphone"); ?>
        </h4>
        <ul class="list-group-flush">
            <?php foreach ($this->numerosTel as $numero) {?>
                <li class="list-group-item">
                    <i class="bi bi-telephone me-3"></i><?php echo $numero->numero; ?>
                </li>
            <?php } ?>
        </ul>
        <?php
    }

    public function afficher() {
?>
        <div class="container border">
            <div class="ps-5 pt-3">
                <h2>
                    <?php echo $this->prenom . ' ' . $this->nom; ?>
                </h2>
                <p class="border-bottom pb-2 w-25">
                    Client  <?php echo $this->grade; ?>
                </p>
            </div>
            <div>
                <div class="row gx-5">
                    <div class="col"><?php $this->afficherContact(); ?></div>
                    <div class="col"><?php $this->afficherAdresse(); ?></div>
                    <div class="col"><?php $this->afficherNumero(); ?></div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <h4 class="ps-5">Informations</h4>
                        <ul class="list-group-flush">
                            <li class="list-group-item">Montant dépensé : <?php echo $this->totalDepense; ?> €</li>
                            <li class="list-group-item">Remise future : <?php echo $this->remise_future; ?> €</li>
                            <li class="list-group-item">Adhérant : <?php echo ($this->adhérant) ? "Oui" : "Non"; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <a class="mt-4 float-end btn btn-primary" href="editer_fiche_client.php?id_client=<?php echo $this->id; ?>">Editer la fiche</a>

        </div>
        </div>

<?php
    }

    private function afficherAdresse_edition() {
        ?>
        <h4 class="ps-5 mt-2">
            <?php echo (count($this->adresses) == 1) ? "Adresse" : "Adresses"; ?>
        </h4>
        <ul class="list-group-flush">
            <?php foreach ($this->adresses as $adresse) {?>
                <li class="list-group-item">
                    <?php echo
                        $adresse->numero . ' '
                        . $adresse->rue . ', '
                        . $adresse->codePostal . ' '
                        . $adresse->ville; ?>
                </li>
                <li class="list-group-item">
                    <?php
                    $Server="localhost";
                    $User="root";
                    $Pwd="";
                    $DB="entreprise";
                    $Connect = mysqli_connect($Server, $User, $Pwd, $DB);

                    $id_adresse=mysqli_fetch_array($Connect->query("SELECT id_adresse FROM adresse WHERE id_client =".$this->id." AND numero ='".$adresse->numero."' AND rue='".$adresse->rue."' AND ville = '".$adresse->ville."' AND code_postal = ".$adresse->codePostal));
                    echo '<a href="liste_clients.php?supprimer='.$id_adresse[0].'">
                    <input  id="submit" value="Supprimer"/></a> ' ;?>
                </li>

            <?php

                    } ?>
        </ul>
        <?php
    }

    private function afficherNumero_edition() {
        ?>
        <h4 class="ps-5 mt-2">
            <?php echo "Numéro" . ((count($this->numerosTel) == 1) ? " de téléphone" : "s de téléphone"); ?>
        </h4>
        <ul class="list-group-flush">
            <?php foreach ($this->numerosTel as $numero) {?>
                <li class="list-group-item">
                    <i class="bi bi-telephone me-3"></i><?php echo $numero->numero; ?>
                </li>
                <li class="list-group-item">
                    <?php
                    echo '<a href="liste_clients.php?supprimer_num='. $numero->id .'">
                    <input  id="submit" value="Supprimer"/></a> ' ;?>
                </li>
            <?php } ?>

        </ul>
        <?php
    }

        public function afficher_edition() {
?>
        <div class="container border">
            <div class="ps-5 pt-3">
                <h2>
                    <?php echo $this->prenom . ' ' . $this->nom; ?>
                </h2>
                <p class="border-bottom pb-2 w-25">
                    Client  <?php echo $this->grade; ?>
                </p>
            </div>
            <div>
                <div class="row gx-5">
                    <div class="col"><?php $this->afficherContact(); ?></div>

                    <div class="col"><?php $this->afficherAdresse_edition(); ?></div>

                    <div class="col"><?php $this->afficherNumero_edition(); ?></div>

                </div>
            </div>
            <div class="row">

            <div class="col-3">
                <span>Montant dépensé : <?php echo $this->totalDepense; ?> €</span>
            </div>
            <div class="col-3">
                <span>Remise future : <?php echo $this->remise_future; ?> €</span>
            </div>
            <div class="col-3">
                <span>Adhérant : <?php echo $this->adhérant; ?> </span>

            </div>



        </div>
        </div>

<?php
    }

    public function afficherApercu() {
        ?>
        <div class="row">
            <div class="col-3">
                <span><?php echo $this->prenom . ' ' . $this->nom; ?></span>
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

    public function getId()
    {
        return $this->id;
    }
}
