<?php

function recupererValeurPoint() {
    // Récupération des points liées au client
    require_once 'connexion.php';

    $db = creerConnexion();
    $result = $db->query("SELECT valeur FROM valeurpoint WHERE id_valeur_point = 1");

    return $result->fetch_all()[0][0];
}

function creerPoint($id_solde) {
    // Récupération des points liées au client
    require_once 'connexion.php';

    $db = creerConnexion();
    $req = "SELECT quantite, intitule, date_expiration FROM soldepoint WHERE CURRENT_DATE < date_expiration AND id_solde_point = " . $id_solde;
    $result = $db->query($req);

    if(!$result) {
        echo '<p>Erreur : ' . $db->error . '</p>';
    }
    while($p = $result->fetch_assoc()) {
        $point = new Point($id_solde, $p["quantite"], $p["intitule"], $p["date_expiration"]);
        return $point;
    }
}

function recupererPointsClient($id_client) {
    $points = [];

    // Récupération des points liées au client
    require_once 'connexion.php';

    $db = creerConnexion();
    $req = "SELECT id_solde_point, quantite, intitule, date_expiration FROM soldepoint WHERE CURRENT_DATE < date_expiration AND id_client = " . $id_client;
    $result = $db->query($req);

    if(!$result) {
        echo '<p>Erreur : ' . $db->error . '</p>';
    }
    while($p = $result->fetch_assoc()) {
        $points[] = new Point($p["id_solde_point"], $p["quantite"], $p["intitule"], $p["date_expiration"]);
    }

    return $points;
}

class Point
{
    public $intitule;
    public $quantite;
    public $id_solde;
    public $date_expiration;

    public function __construct($id_solde, $quantite, $intitule, $date_expiration)
    {
        $this->date_expiration = $date_expiration;
        $this->id_solde = $id_solde;
        $this->quantite = $quantite;
        $this->intitule = $intitule;
    }
}