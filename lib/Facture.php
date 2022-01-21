<?php

class Facture
{
    public $articles = [];
    public $id_commande;
    private $total_ht;
    public $id_client;

    public $frais_livraison;
    public $frais_service;
    public $remise;

    public function __construct($id_commande, $id_client)
    {
        $this->id_commande = $id_commande;
        $this->id_client = $id_client;
    }

    private function calculerHT() {
        $total = 0;
        foreach ($this->articles as $article) {
            $total += $article->prix_unite * $article->quantite;
        }

        return $total;
    }

    public function totalTTC() {
        return $this->CalculerHT() + $this->frais_livraison + $this->frais_service - $this->remise;
    }

}