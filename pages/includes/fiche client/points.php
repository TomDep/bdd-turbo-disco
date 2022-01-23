<?php
/** @var $client Client */

require_once '../lib/Point.php';

?>

<h4>Soldes du client</h4>

<ul class="list-group-flush ps-0">
    <?php
    $points = recupererPointsClient($client->id);
    $valeur_point = recupererValeurPoint();

    if(count($points) > 0) {
        foreach ($points as $i => $point) {
            echo '<li class="list-group-item">' . $point->intitule . ' : ' . $point->quantite . ' points • ' . formaterPrix($point->quantite * $valeur_point) . '</li>';
        }
    } else {
        echo '<p>Le client n\'a pas de soldes.</p>';
    }
    ?>
</ul>

<h4>Ajouter des points</h4>

<hr>

<div class="row">
    <div class="col">
        <h5>Création d'un nouveau solde</h5>

        <form action="../lib/creer_solde.php" method="get">

            <input hidden name="id_client" value="<?php echo $client->id ?>">

            <div class="mb-3">
                <label class="form-label">Intitulé du solde</label>
                <input type="text" name="intitule" required class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre de points à ajouter</label>
                <input type="number" name="quantite" required class="form-control">
            </div>

            <input class="btn btn-primary" value="Créer" type="submit">
        </form>
    </div>
    <div class="col">
        <form method="get" action="../lib/modifier_solde.php">

            <input hidden name="id_client" value="<?php echo $client->id ?>">

            <h5>Soldes existant</h5>

            <?php

            if(count($points) > 0) {
                echo '<label class="form-label">Sélection du solde</label>';
                echo '<select class="form-select mb-3" name="id_solde">';
                foreach ($points as $i => $point) {
                    echo '<option value="'. $point->id_solde .'">' . $point->intitule . ' : ' . $point->quantite . ' points • ' . formaterPrix($point->quantite * $valeur_point) . '</option>';
                }
                ?>
                </select>

                <div class="mb-3">
                    <label class="form-label">Nombre de points à ajouter</label>
                    <input type="number" name="montant" required class="form-control">
                </div>

                <input type="submit" class="btn btn-primary" value="Ajouter">

                <?php
            } else {
                echo '<p>Le client n\'a pas de soldes.</p>';
            }
            ?>
        </form>
    </div>
</div>