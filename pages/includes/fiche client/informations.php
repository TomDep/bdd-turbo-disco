<?php
/** @var $client Client */
?>

<h2>
    <?php echo $client->prenom . ' ' . $client->nom; ?>
</h2>
<p class="pb-2">
    Client  <?php echo $client->grade; ?>
</p>

<a class="btn btn-outline-primary" href="editer_fiche_client.php?id_client=<?php echo $client->id; ?>">
    <i class="bi bi-pencil me-2"></i>
    Editer la fiche
</a>

<hr>

<div class="row gx-5">
    <div class="col">
        <h4 class="ps-5 mt-2">Contact</h4>
        <ul class="list-group-flush">
            <li class="list-group-item"><i class="bi bi-envelope me-3"></i><?php echo $client->email; ?></li>
            <li class="list-group-item"><i class="bi bi-facebook me-3"></i><?php echo $client->facebook; ?></li>
            <li class="list-group-item"><i class="bi bi-instagram me-3"></i><?php echo $client->instagram; ?></li>
        </ul>
    </div>
    <div class="col">
        <h4 class="ps-5 mt-2">
            <?php echo (count($client->adresses) == 1) ? "Adresse" : "Adresses"; ?>
        </h4>
        <ul class="list-group-flush">
            <?php foreach ($client->adresses as $adresse) {?>
                <li class="list-group-item">
                    <?php echo
                        $adresse->numero . ' '
                        . $adresse->rue . ', '
                        . $adresse->codePostal . ' '
                        . $adresse->ville; ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col">
        <h4 class="ps-5 mt-2">
            <?php echo "Numéro" . ((count($client->numerosTel) == 1) ? " de téléphone" : "s de téléphone"); ?>
        </h4>
        <ul class="list-group-flush">
            <?php foreach ($client->numerosTel as $numero) {?>
                <li class="list-group-item">
                    <i class="bi bi-telephone me-3"></i><?php echo $numero->numero; ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-auto">
        <h4 class="ps-5">Informations</h4>
        <ul class="list-group-flush">
            <li class="list-group-item">Montant dépensé : <?php echo $client->total_depense; ?> €</li>
            <li class="list-group-item">Remise future : <?php echo $client->remise_future; ?> €</li>
            <li class="list-group-item">Adhérant : <?php echo ($client->adherant) ? "Oui" : "Non"; ?></li>
            <li class="list-group-item">VIP : <?php echo ($client->est_vip) ? "Oui" : "Non"; ?></li>
        </ul>
    </div>
</div>