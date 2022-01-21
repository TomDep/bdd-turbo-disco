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

    <a class="mb-3 btn btn-outline-primary" href="../lib/Excel.php">
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

$request = $db->query("SELECT id_commande, id_client, id_status_commande, date_passage, date_validation, date_cloture FROM commande");
while($ligne = mysqli_fetch_array($request)) {
    $commande = new Commande($ligne['id_commande'], creerClient($ligne['id_client']));

    // Mise à jour du status
    switch ($ligne["id_status_commande"]) {
        case 1:
            $commande->changerStatut(StatutCommande::en_cours);
            $commande->ajouterDerniereDate($ligne["date_validation"]);
            break;
        case 2:
            $commande->changerStatut(StatutCommande::livree);
            $commande->ajouterDerniereDate($ligne["date_cloture"]);
            break;
        case 3:
            $commande->changerStatut(StatutCommande::annulee);
            $commande->ajouterDerniereDate($ligne["date_cloture"]);
            break;
        case 4:
            $commande->changerStatut(StatutCommande::attente_validation);
            $commande->ajouterDerniereDate($ligne["date_passage"]);
            break;
    }

    $commande->ajouterCommentaire("Pas de commentaire.");

    // Getting the articles
    $request2 = $db->query("SELECT * FROM itemcommande WHERE id_commande=" . $ligne['id_commande']);
    while ($ligne2 = mysqli_fetch_array($request2)) {
        $article = mysqli_fetch_array($db->query("SELECT * FROM article WHERE id_article=" . $ligne2['id_article']));
        $commande->ajouterArticle(new ArticleCommande($article['id_article'], $article['intitule'], $ligne2['quantite'], $article['prix_unitaire']));
    }
?>
            <tr>
                <td><span class="badge bg-secondary ms-3">#<?php echo $commande->id; ?></span></td>
                <td><?php echo $commande->afficherIconeStatut(); ?></td>
                <td><?php echo $commande->afficherNomStatut(); ?></td>
                <td><?php echo $commande->afficherDerniereDate(); ?></td>
                <td><?php echo count($commande->articles); ?> article(s)</td>
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
