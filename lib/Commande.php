<?php

abstract class StatutCommande {
    const attente_validation    = 0;
    const en_cours              = 1;
    const livree                = 2;
    const annulee               = 3;
}

class Commande
{
    private $id;

    // Dates
    private $datePassage = "10/12/21";
    private $dateValidation = "13/12/21";
    private $dateArrivee = "28/12/21";

    private $statut;

    private $articles = [5632, 5632];

    private $items;
    private $id_client;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function afficherAppercu() {
        ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <div class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-commande-<?php echo $this->id; ?>">
                    <?php $this->afficherIconeStatut(); ?>
                    <?php $this->afficherNomStatut(); ?>
                    <?php $this->afficherDerniereDate(); ?>

                    <span class="ms-auto"><?php echo count($this->articles); ?> article(s)</span>
                    <span class="badge bg-secondary ms-3 ms-auto">Commande #<?php echo $this->id; ?></span>
                </div>
            </h2>
            <div id="collapse-commande-<?php echo $this->id; ?>" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
            </div>
        </div>
        <?php
    }

    public function changerStatut($statut)
    {
        $this->statut = $statut;
    }

    private function afficherIconeStatut()
    {

        switch ($this->statut) {
            case StatutCommande::attente_validation:
                echo '<i class="bi bi-circle me-3"></i>';
                break;
            case StatutCommande::en_cours:
                echo '<i class="bi bi-slash-circle me-3"></i>';
                break;
            case StatutCommande::livree:
                echo '<i class="bi bi-check2-circle me-3"></i>';
                break;
        }
    }

    private function afficherNomStatut()
    {
        switch ($this->statut) {
            case StatutCommande::attente_validation:
                echo '<span>En attente de validation</span>';
                break;
            case StatutCommande::en_cours:
                echo '<span>Commande en cours</span>';
                break;
            case StatutCommande::livree:
                echo '<span>Commande livrée</span>';
                break;
        }
    }

    private function afficherDerniereDate()
    {
        switch ($this->statut) {
            case StatutCommande::attente_validation:
                echo '<small class="ms-3"> depuis le '. $this->datePassage .'</small>';
                break;
            case StatutCommande::en_cours:
                echo '<small class="ms-3"> depuis le '. $this->dateValidation .'</small>';
                break;
                case StatutCommande::livree:
                echo '<small class="ms-3"> le '. $this->dateArrivee .'</small>';
                break;
        }
    }
}