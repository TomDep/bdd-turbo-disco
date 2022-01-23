<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Éditer une fiche client</title>
    <?php  include("../templates/links.php");  ?>
</head>

<?php  include("../templates/menu.php");  ?>

<div class="container p-5">

<?php

if(!isset($_GET["id_client"])) {
    header("Location: liste_clients.php");
}

require_once("../lib/Client.php");

$client = creerClient($_GET["id_client"]);

?>
    <div class="container border rounded">
        <form method="post" action="fiche_client.php?id_client=<?php echo $client->id ?>">

        <div class="ps-5 pt-3">
            <h2>
                <?php echo $client->prenom . ' ' . $client->nom; ?>
            </h2>
            <p class="border-bottom pb-2 w-25">
                Client  <?php echo $client->grade; ?>
            </p>
        </div>
        <div>
            <div class="row gx-5">
                <div class="col">
                    <h4 class="ps-5 mt-2">Contact</h4>
                    <ul class="list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-envelope me-3"></i>
                            <input type="text" name="mail" value="<?php echo $client->email; ?>">
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-facebook me-3"></i>
                            <input type="text" name="facebook" value="<?php echo $client->facebook; ?>">
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-instagram me-3"></i>
                            <input type="text" name="instagram" value="<?php echo $client->instagram; ?>">
                        </li>
                    </ul>
                </div>

                <div class="col">
                    <h4 class="ps-5 mt-2">
                        <?php echo (count($client->adresses) == 1) ? "Adresse" : "Adresses"; ?>
                    </h4>
                    <ul class="list-group-flush">
                        <?php foreach ($client->adresses as $i => $adresse) {?>
                            <li class="list-group-item">
                                <p>
                                    <?php echo
                                        $adresse->numero . ' '
                                        . $adresse->rue . ', '
                                        . $adresse->codePostal . ' '
                                        . $adresse->ville; ?>

                                    <?php if($i != 0) { ?>
                                        <a href="../lib/supprimer_adresse.php?id_client=<?php echo $client->id ?>&id_adresse=<?php echo $adresse->id; ?>" type="button" class="float-end btn btn-outline-danger btn-sm">X</a>
                                    <?php } ?>
                                </p>
                            </li>
                            <?php

                        } ?>
                    </ul>
                </div>

                <div class="col">
                    <h4 class="ps-5 mt-2">
                        <?php echo "Numéro" . ((count($client->numerosTel) == 1) ? " de téléphone" : "s de téléphone"); ?>
                    </h4>
                    <ul class="list-group-flush">
                        <?php foreach ($client->numerosTel as $i => $numero) {?>
                            <li class="list-group-item">
                                <p>
                                    <i class="bi bi-telephone me-3"></i><?php echo $numero->numero; ?>

                                    <?php if($i != 0) { ?>
                                        <a href="../lib/supprimer_numero.php?id_client=<?php echo $client->id ?>&id_numero=<?php echo $numero->id; ?>" type="button" class="float-end btn btn-outline-danger btn-sm">X</a>
                                    <?php } ?>
                                </p>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <h4 class="ps-5">Informations</h4>

                <ul class="list-group-flush">
                    <li class="list-group-item">Montant dépensé : <?php echo $client->total_depense; ?> €</li>
                    <li class="list-group-item">Remise future : <?php echo $client->remise_future; ?> €</li>
                    <li class="list-group-item">
                        <div class="form-check form-switch ps-0">
                            <label class="form-check-label" for="i-adherent">Adhérent :</label>
                            <input class="form-check-input float-end" id="i-adherent" type="checkbox" role="switch" name="adherent" <?php if($client->adherant) echo "checked" ?>>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check form-switch ps-0">
                            <label class="form-check-label" for="i-vip">VIP :</label>
                            <input class="form-check-input float-end" id="i-vip" type="checkbox" role="switch" name="vip" <?php if($client->est_vip) echo "checked" ?>>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-dark border-top w-100 p-2" style="position: fixed; bottom: 0px; left: 0px; z-index: 1000">
            <button class="btn btn-success float-end" type="submit" name="submit" value="Submit">
                <i class="bi bi-check-square me-2"></i>
                Valider les modifications</button>
            <a class="btn btn-outline-light float-end me-2" href="fiche_client.php?id_client=<?php echo $client->id;?>">
                <i class="bi bi-x-square me-2"></i>
                Annuler les modifications</a>
        </div>

        </form>
    </div>
    <div class="container border rounded mt-4 mb-5">
        <h4 class="ps-5 pt-1 mt-3">Ajouter une adresse</h4>
        <form class="ps-5 p-2" action="../lib/ajouter_adresse.php" method="get">
            <input hidden name="id_client" value="<?php echo $client->id; ?>"">

            <div class="input-group mb-3">
                <input class="form-control" type="text" placeholder="Numero de rue" name="numero" >
                <input class="form-control" type="text" placeholder="Nom de rue" name="rue" >
                <input class="form-control" type="text" placeholder="Ville" name="ville" >
                <input class="form-control" type="number" placeholder="Code postal" name="code_postal" >
            </div>
            <input class="btn btn-primary" type='submit'  id='submit' value='Ajouter adresse' >
        </form>

        <hr class="ms-4 me-4">

        <h4 class="ps-5 pt-1">Ajouter un numéro de téléphone</h4>
        <form class="ps-5 p-2" action="../lib/ajouter_numero.php" method="post">
            <input hidden name="id_client" value="<?php echo $client->id; ?>"">

            <div class="input-group">
                <input class="form-control" type="text" placeholder="+33 7 83 55 79 62" name="numero_tel" >
                <input class="btn btn-primary" type='submit' id='submit'  value='Ajouter un numéro de téléphone' >
            </div>
        </form>
    </div>

</div>


</body>
</html>
