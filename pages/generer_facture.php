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

    $Connect = creerConnexion();
    $ligne=mysqli_fetch_array($Connect->query("SELECT id_client FROM commande WHERE id_commande=".$_GET['id_commande']));
    $client1 = creerClient($ligne[0]);

    $commande= new Commande($_GET['id_commande'],$client1);

    ?>




    <div class="container p-5 mt-4 rounded shadow-lg">
        <h1>Commande n°<?php echo $commande->id ?> </h1>

        <div class="border rounded mt-3 p-3">
            <h4>Ajouter un acompte :</h4>

            <p>Le montant total de la commande est de <span class="fw-bold"><?php echo mysqli_fetch_array($Connect->query("SELECT prix_total FROM commande WHERE id_commande=".$_GET['id_commande']))['prix_total'] ?> €</span>
                <br>
                Vous ne pouvez pas déposer d'acompte avec les points de fidélité.
            </p>

            <form method="GET" action="../lib/creer_acompte.php">
                <label class="form-label">Montant</label>
                <input class="form-control" type="number" name="montant">

                <label class="form-label mt-3">Type de paiement</label>
                <select class="form-select" name="type_paiement">
                    <option value="1">Chèque</option>
                    <option value="2">Espèces</option>
                    <option value="3">Carte banquaire</option>
                </select>

                <input hidden name="id_commande" value="<?php echo $commande->id ?>">

                <input type="submit" class="btn btn-primary mt-3" value="Ajouter">
            </form>
            <form action="editer_commande.php">
                <input hidden name="id_commande" value="<?php echo $commande->id ?>">
                <input type="submit" class="btn btn-primary mt-3" value="Passer">
            </form>

        </div>
    </div>
    </body>



</html>