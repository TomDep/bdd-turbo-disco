<?php
require_once '../lib/ArticleCommande.php';
require_once '../lib/Facture.php';

session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Générer une facture</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<?php
$facture = $_SESSION["facture"];

$facture->frais_livraison = $_POST["frais-livraison"];
$facture->frais_service = $_POST["frais-service"];
$facture->remise = $_POST["remise"];

$total_a_payer = $facture->totalTTC();
?>

<div class="container p-5 mt-4 rounded shadow-lg">
    <h1>Création d'une facture pour la commande n°<?php echo $facture->id_commande ?> </h1>

    <p>Le total de la facture est de <span class="fw-bold"><?php echo formaterPrix($total_a_payer)?></span></p>

    <div class="border rounded mt-3 p-3">
        <h4>Choississez le moyen de paiement :</h4>

        <p>Il est possible de payer avec les différents points disponibles au client. Dans le cas où les points ne
            suffisent pas à payer la totalité de la commande, il faut completer avec un mode de paiement conventionnel.
        </p>

        <form method="get" action="../lib/paiement_facture.php">
            <div class="row">
                <div class="col">
                    <div>
                        <label class="form-label">Montant</label>
                        <input class="form-control" type="number" name="montant">
                    </div>
                    <div class="mb-1">
                        <label class="form-label mt-3">Type de paiement</label>
                        <select class="form-select" name="type_paiement">
                            <option value="3">Carte banquaire</option>
                            <option value="1">Chèque</option>
                            <option value="2">Espèces</option>
                        </select>
                    </div>

                    <input type="submit" class="btn btn-primary mt-3" value="Valider le paiement">
                </div>

                <div class="col">
                    <h5>Points</h5>

                    <?php

                    require_once '../lib/Point.php';
                    $points = recupererPointsClient($facture->id_client);
                    $valeur_point = recupererValeurPoint();
                    if(count($points) > 0) {
                        echo '<select class="form-select" size="'. count($points) .'" name="id_solde">';
                        foreach ($points as $i => $point) {
                            $valeur = $point->quantite * $valeur_point;

                            echo '<option value="'. $point->id_solde .'">' . $point->intitule . ' : ' . $point->quantite . ' points • ' . formaterPrix($valeur) . ',
                                reste a payer : ' . formaterPrix(max(0, $total_a_payer - $valeur)) .'
                            </option>';
                        }
                    ?>
                    </select>
                    <?php
                    } else {
                        echo '<p>Le client n\'a pas de points.</p>';
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>

