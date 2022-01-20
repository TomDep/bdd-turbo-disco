<?php

require_once '../lib/Commande.php';
require_once '../lib/ArticleCommande.php';
require_once '../lib/Client.php';
require_once '../lib/Utils.php';

session_start();

$commande = $_SESSION["commande"];
$commande->ajouterBDD();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer une nouvelle commande</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5 mt-4 rounded shadow-lg">
    <h1>La commande n°<?php echo $commande->id ?> a été passée avec succès</h1>

    <div class="border rounded mt-3 p-3">
        <h4>Ajouter un acompte :</h4>

        <p>Le montant total de la commande est de <span class="fw-bold"><?php echo formaterPrix($commande->calculerPrixTotal()) ?></span>
            <br>
            Vous ne pouvez pas déposer d'acompte avec les points de fidélité.
        </p>

        <form method="GET" action="../lib/creer_acompte.php">
            <label class="form-label">Montant</label>
            <input class="form-control" type="number" name="amount">

            <label class="form-label mt-3">Type de paiement</label>
            <select class="form-select" name="type_paiement">
                <option value="cheque">Chèque</option>
                <option value="especes">Espèces</option>
                <option value="cb">Carte banquaire</option>
            </select>

            <input hidden name="commande_id" value="<?php echo $commande->id ?>">

            <input type="submit" class="btn btn-primary mt-3" value="Ajouter">
        </form>

    </div>
</div>

</body>

