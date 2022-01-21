<?php

function recupererValeurPoint() {
    // Récupération des points liées au client
    require_once 'connexion.php';

    $db = creerConnexion();
    $result = $db->query("SELECT valeur FROM valeurpoint WHERE id_valeur_point = 1");

    return $result->fetch_all()[0][0];
}

function recupererPointsClient($id_client) {
    $points = [];

    // Récupération des points liées au client
    require_once 'connexion.php';

    $db = creerConnexion();
    $req = "SELECT quantite, intitule, date_expiration FROM soldepoint WHERE CURRENT_DATE < date_expiration AND id_client = " . $id_client;
    $result = $db->query($req);

    if(!$result) {
        echo '<p>Erreur : ' . $db->error . '</p>';
    }
    while($p = $result->fetch_assoc()) {
        $points[] = new Point($p["quantite"], $p["intitule"]);
    }

    return $points;
}

class Point
{
    public $intitule;
    public $quantite;

    public function __construct($quantite, $intitule)
    {
        $this->quantite = $quantite;
        $this->intitule = $intitule;
    }
}