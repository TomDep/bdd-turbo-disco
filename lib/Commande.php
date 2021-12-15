<?php

abstract class StatutCommande {
    const attente_validation    = 0;
    const en_cours              = 1;
    const livree                = 2;
    const annulee               = 3;

    const couleur_attente_validation    = "#2f2fff";
    const couleur_en_cours              = "#c8a900";
    const couleur_livree                = "#119822";
    const couleur_annulee               = "#F93943";
}

class Commande
{
    private $id;

    // Dates
    private $derniereDate = "15/11/2021";

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
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-commande-<?php echo $this->id; ?>">
                    <div style="width: 20%">
                        <?php $this->afficherIconeStatut(); ?>
                        <?php $this->afficherNomStatut(); ?>
                    </div>
                    <div class="w-25">
                        <?php $this->afficherDerniereDate(); ?>
                    </div>

                    <span class="w-25"><?php echo count($this->articles); ?> article(s)</span>
                    <span class="badge bg-secondary ms-3">Commande #<?php echo $this->id; ?></span>
                </button>
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
                echo '<i class="bi bi-circle me-3" style="color: '. StatutCommande::couleur_attente_validation .'"></i>';
                break;
            case StatutCommande::en_cours:
                echo '<i class="bi bi-slash-circle me-3" style="color: '. StatutCommande::couleur_en_cours .'"></i>';
                break;
            case StatutCommande::livree:
                echo '<i class="bi bi-check-circle me-3" style="color: '. StatutCommande::couleur_livree .'"></i>';
                break;
            case StatutCommande::annulee:
                echo '<i class="bi bi-x-circle me-3" style="color: '. StatutCommande::couleur_annulee .'"></i>';
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
            case StatutCommande::annulee:
                echo '<span>Commande annulée</span>';
                break;
        }
    }

    private function afficherDerniereDate()
    {
        switch ($this->statut) {
            case StatutCommande::en_cours:
            case StatutCommande::attente_validation:
                echo '<small class="ms-3"> depuis le '. $this->derniereDate .'</small>';
                break;
            case StatutCommande::annulee:
            case StatutCommande::livree:
                echo '<small class="ms-3"> le '. $this->derniereDate .'</small>';
                break;
        }
    }
}