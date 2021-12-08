<?php

class Adresse
{
    public $numero;
    public $rue;
    public $ville;
    public $codePostal;

    public function __construct($numero, $rue, $codePostal, $ville)
    {
        $this->numero = $numero;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
    }

    public function afficher() {

    }
}

class FicheClient
{
    private $nom;
    private $prenom;
    private $grade;

    // Adresses
    private $adresses = [];

    // Numéros
    private $numerosTel = [];

    // Contact
    private $facebook;
    private $instagram;
    private $email;

    public function __construct($nom, $prenom, $grade, $facebook, $instagram, $email)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->grade = $grade;
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->email = $email;
    }

    public function ajouterNumeroTelephone($numero) {
        $this->numerosTel[] = $numero;
    }

    public function ajouterAdresse($adresse) {
        $this->adresses[] = $adresse;
    }

    private function afficherContact() {
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
            <?php } ?>
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
                    <?php echo $numero; ?>
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
            </div>
        </div>
<?php
    }
}