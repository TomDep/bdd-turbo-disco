<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Éditer une commande</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>
<?php

require_once '../lib/Commande.php';
require_once '../lib/Client.php';
require_once '../lib/ArticleCommande.php';

//paramètres de connexion à la base de données
$Server = "localhost";
$User = "root";
$Pwd = "";
$DB = "entreprise";

//connexion au serveur où se trouve la base de données
$Connect = mysqli_connect($Server, $User, $Pwd, $DB);

//affichage d’un message d’erreur si la connexion a été refusée
if (!$Connect)
    echo "Connexion à la base impossible";


session_start();


$request=$Connect->query("SELECT * FROM commande WHERE id_commande=".$_GET['id_commande']);
while($ligne = mysqli_fetch_array($request)) {
    $client1 = creerClient($ligne['id_client']);
    $commande1 = new Commande($ligne['id_commande'], $client1);
    if ($ligne['id_status_commande'] == 1) {
        $commande1->changerStatut(StatutCommande::en_cours);
    }
    if ($ligne['id_status_commande'] == 2) {
        $commande1->changerStatut(StatutCommande::livree);
    }
    if ($ligne['id_status_commande'] == 3) {
        $commande1->changerStatut(StatutCommande::annulee);
    }
    if ($ligne['id_status_commande'] == 4) {
        $commande1->changerStatut(StatutCommande::attente_validation);
    }

    $commande1->ajouterCommentaire("Pas de commentaire.");

    $request2 = $Connect->query("SELECT * FROM itemcommande WHERE id_commande=" . $ligne['id_commande']);
    while ($ligne2 = mysqli_fetch_array($request2)) {
        $article = mysqli_fetch_array($Connect->query("SELECT * FROM article WHERE id_article=" . $ligne2['id_article']));
        $commande1->ajouterArticle(new ArticleCommande($article['id_article'], $article['intitule'], $ligne2['quantite'], $article['prix_unitaire']));
    }
}?>

<div class="container p-5">
    <div class="row">
        <div class="col">
            <table class="mb-3">
                <h4>Commande <span>n°<?php echo $commande1->getId(); ?></span></h4>
                <tr>
                    <td><?php $commande1->afficherIconeStatut(); ?></td>
                    <td><?php $commande1->afficherNomStatut(); ?></td>
                    <td><?php $commande1->afficherDerniereDate(); ?></td>
                    <td></td>
                </tr>
            </table>

            <?php
            $statut = $commande1->recupererStatus();
            switch($statut) {
                case StatutCommande::attente_validation:
                    echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande1->getId() ."&statut_actuel=". $commande1->recupererStatus() ."' class='btn btn-success'>Valider la commande</a>";
                    echo '<a href="../lib/annuler_commande.php?id_commande=<?php echo $commande1->getId(); ?>" class="btn btn-danger">Annuler la commande</a>';
                    echo '<a href="generer_facture.php?id_commande=<?php echo $commande1->getId(); ?>" class="btn btn-outline-secondary">Générer la facture</a>';
                    break;
                case StatutCommande::en_cours:
                    echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande1->getId() ."&statut_actuel=". $commande1->recupererStatus() ."' class='btn btn-success'>Valider que la commande a bien été livrée</a>";
                    echo '<a href="../lib/annuler_commande.php?id_commande=<?php echo $commande1->getId(); ?>" class="btn btn-danger">Annuler la commande</a>';
                    echo '<a href="generer_facture.php?id_commande=<?php echo $commande1->getId(); ?>" class="btn btn-outline-secondary">Générer la facture</a>';
                    break;

                case StatutCommande::annulee:
                   break;
            }

            ?>


        </div>
    </div>
    <div class="row mt-4">

        <?php $commande1->afficherArticlesEdition(); ?>
    </div>
</div>

</body>
</html>