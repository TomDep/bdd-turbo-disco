<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des commandes</title>
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


$request=$Connect->query("SELECT * FROM commande");
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
?>
<div class="container p-5">
    <div class="accordion">
        <?php

            $commande1->afficherAppercu();

        ?>
    </div>

</div>
<?php
}
?>




</body>
</html>
