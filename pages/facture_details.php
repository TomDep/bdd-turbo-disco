<?php
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
require_once '../lib/Commande.php';
require_once '../lib/Client.php';
require_once '../lib/ArticleCommande.php';
require_once '../lib/Facture.php';

$commande = creerCommande($_GET["id_commande"]);
$facture = new Facture($_GET["id_commande"], $commande->client->id);

foreach ($_POST as $id_article => $t) {
    foreach ($commande->articles as $article_cmd) {
        if($article_cmd->id == $id_article) {
            $facture->articles[] = $article_cmd;
            break;
        }
    }
}

$_SESSION["facture"] = $facture;
?>

<div class="container p-5 mt-4 rounded shadow-lg">
    <h1>Création d'une facture pour la commande n°<?php echo $_GET["id_commande"] ?> </h1>

    <div class="border rounded mt-3 p-3">
        <h4>Frais et remises :</h4>

        <form method="post" action="facture_paiement.php" autocomplete="off">
            <div class="mb-3">
                <label for="i-frais-service" class="form-label">Frais de services</label>
                <input type="number" class="form-control" id="i-frais-service" name="frais-service" required value="0">
            </div>
            <div class="mb-3">
                <label for="i-frais-livraison" class="form-label">Frais de livraison</label>
                <input type="number" class="form-control" id="i-frais-livraison" name="frais-livraison" required value="0">
            </div>
            <div class="mb-3">
                <label for="i-remise" class="form-label">Remise</label>
                <input type="number" class="form-control" id="i-remise" name="remise" required value="0">
            </div>

            <input type="submit" class="btn btn-primary" value="Accèder au paiement">
            <a class="btn btn-outline-secondary secondary" href="commande.php?id_commande=<?php echo $commande->id ?>">Retour</a>

        </form>

    </div>
</div>

</body>
</html>