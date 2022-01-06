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
    private $payee = false;

    private $articles = [];
    private $commentaire = "";

    private $client;

    public function __construct($id, $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    private function calculerPrixTotal()
    {
        $fmt = new NumberFormatter("fr_FR", NumberFormatter::CURRENCY);
        $total = 0;
        foreach($this->articles as $i => $article) {
            $total += $article->recupererTotal();
        }

        return $fmt->formatCurrency($total, "EUR");
    }

    public function afficherAppercu() {
        ?>
        <div class="accordion-item">
            <?php $this->afficherHeader(); ?>
            <div id="collapse-commande-<?php echo $this->id; ?>" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col"><?php $this->afficherInfosClient(); ?></div>
                        <div class="col">
                            <h4>Commentaire</h4>
                            <hr>
                            <p>
                                <?php echo (empty($this->commentaire)) ? "Pas de commentaire" : $this->commentaire; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><?php $this->afficherArticles(); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
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

    private function afficherArticles()
    {
        ?>
        <h4>Articles</h4>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix unité</th>
                    <th scope="col">Prix total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($this->articles as $i => $article) {
                $article->afficherLigneCommande($i);
            }
            ?>
            <tr class="table-active">
                <td></td>
                <td></td>
                <td></td>
                <td class="fw-bold">Total</td>
                <td class="fw-bold"><?php echo $this->calculerPrixTotal(); ?></td>
            </tr>
            </tbody>
        </table>
        <?php
    }

    private function afficherInfosClient()
    {
        ?>
        <h4>Informations client</h4>
        <hr>
        <ul class="list-group-flush">
            <li class="list-group-item">No. client : <?php echo $this->client->getId(); ?></li>
            <li class="list-group-item">Client : <?php echo $this->client->getNomPrenom(); ?></li>
            <li class="list-group-item">No. client : <?php echo $this->client->getId(); ?></li>
        </ul>
        <?php
    }

    private function afficherHeader()
    {
        ?>
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
                <span><?php echo ($this->payee) ? "payée" : "non payée"; ?></span>

                <span class="badge bg-secondary ms-3">Commande #<?php echo $this->id; ?></span>
            </button>
        </h2>
        <?php
    }

    /* ----- Getters & Setters ----- */
    public function changerStatut($statut)
    {
        $this->statut = $statut;
    }

    public function ajouterArticle($article) {
        $this->articles[] = $article;
    }

    public function estPayee($payee)
    {
        $this->payee = $payee;
    }

    public function ajouterCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }
}