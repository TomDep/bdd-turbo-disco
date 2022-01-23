<?php
    require_once '../lib/Commande.php';
    require_once '../lib/Client.php';
    require_once '../lib/ArticleCommande.php';
    require_once '../lib/connexion.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des commandes</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5 mt-4 rounded shadow-lg">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liste des commandes</li>
        </ol>
    </nav>

    <a class="mb-3 btn btn-outline-primary" href="../lib/Excel.php" target="_blank">
        <i class="bi bi-box-arrow-down me-2"></i>
        Exporter les commandes dans un fichier CSV</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th>Status</th>
                <th>Dernière actualisation</th>
                <th>Nombre d'articles</th>
                <th>Payée</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
<?php
$db = creerConnexion();

$request = $db->query("SELECT COUNT(*) FROM commande");
$nb_commandes = $request->fetch_all()[0][0];

if($nb_commandes == 0) {
    echo '<tr><td>Il n\'y a pas de commandes</td></tr>';
}

$request = $db->query("SELECT id_commande, id_status_commande, id_client FROM commande ORDER BY id_status_commande");
while($ligne = mysqli_fetch_array($request)) {
    $commande = creerCommande($ligne["id_commande"]);

?>
            <tr>
                <td><span class="badge bg-secondary ms-3">#<?php echo $commande->id; ?></span></td>
                <td><?php echo $commande->afficherIconeStatut(); ?></td>
                <td><?php echo $commande->afficherNomStatut(); ?></td>
                <td><?php echo $commande->afficherDerniereDate(); ?></td>
                <td><?php echo count($commande->articles); ?> article(s)</td>
                <td><?php echo ($commande->payee) ? '<i class="bi bi-check"></i>' : '<i class="bi bi-x"></i>' ?></td>
                <td><a href="commande.php?id_commande=<?php echo $commande->id ?>">Voir</a></td>
            </tr>
<?php
}
?>
        </tbody>
    </table>
</div>

</body>
</html>
