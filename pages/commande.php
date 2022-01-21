<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Commande</title>

    <?php  include("../templates/links.php");  ?>
</head>
<body>
    <?php  include("../templates/menu.php");  ?>
</body>

<?php

require_once '../lib/Commande.php';
require_once '../lib/connexion.php';

$commande = creerCommande($_GET["id_commande"]);
$db = creerConnexion();

?>

<div class="container p-5 mt-4 rounded shadow-lg">
    <div class="row">
        <div class="col">
            <table class="mb-3">
                <h4>Commande <span>n°<?php echo $commande->getId(); ?></span></h4>
                <tr>
                    <td><?php $commande->afficherIconeStatut(); ?></td>
                    <td><?php $commande->afficherNomStatut(); ?></td>
                    <td><?php $commande->afficherDerniereDate(); ?></td>
                </tr>
            </table>

            <?php
            switch($commande->recupererStatus()) {
                case StatutCommande::attente_validation:
                    echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande->getId() ."&statut_actuel=". $commande->recupererStatus() ."' class='btn btn-success me-3'>Valider la commande</a>";
                    echo '<a href="../lib/annuler_commande.php?id_commande='. $commande->getId() .'" class="btn btn-danger me-3">Annuler la commande</a>';
                    $ligne=mysqli_fetch_array($db->query("SELECT est_payee FROM commande WHERE id_commande=".$commande->getId()));
                    if($ligne['est_payee']==0){
                        echo '<a href="generer_facture.php?id_commande='. $commande->getId() .'" class="btn btn-outline-secondary me-3">Procéder au paiement</a>';
                    }
                    break;
                    case StatutCommande::en_cours:
                    echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande->getId() ."&statut_actuel=". $commande->recupererStatus() ."' class='btn btn-success me-3'>Valider que la commande a bien été livrée</a>";
                    echo '<a href="../lib/annuler_commande.php?id_commande='. $commande->getId() .'" class="btn btn-danger me-3">Annuler la commande</a>';
                    $ligne=mysqli_fetch_array($db->query("SELECT est_payee FROM commande WHERE id_commande=".$commande->getId()));
                    if($ligne['est_payee']==0){
                        echo '<a href="generer_facture.php?id_commande='. $commande->getId() .'" class="btn btn-outline-secondary me-3">Procéder au paiement</a>';
                    }

                    break;
                case StatutCommande::annulee:
                    break;
            }
            ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col"><?php $commande->afficherInfosClient(); ?></div>
        <div class="col">
            <h4>Commentaire</h4>
            <hr>
            <p>
                <?php echo (empty($commande->commentaire)) ? "Pas de commentaire" : $commande->commentaire; ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <h4>Paiement(s)</h4>
            <hr>
            <table class="table ms-4">
                <?php
                // Récupération de tous les paiement liés à cette commande
                $req = "SELECT id_type_paiement, type_paiement, montant, date_paiement FROM paiement NATURAL JOIN typepaiement WHERE id_commande = " . $commande->id;
                $result = $db->query($req);
                $paiement_existant = false;

                while($paiement = $result->fetch_assoc()) {
                    $paiement_existant = true;

                    echo '<tr>';

                    echo '<td>';
                    switch ($paiement["id_type_paiement"]) {
                        case 1:
                            echo '<i class="bi bi-card-heading"></i>';
                            break;
                        case 2:
                            echo '<i class="bi bi-cash"></i>';
                            break;
                        case 3:
                            echo '<i class="bi bi-credit-card"></i>';
                            break;
                        case 4:
                            echo '<i class="bi bi-heptagon"></i>';
                            break;
                    }
                    echo '</td>';
                    echo '<td>'. formaterPrix($paiement["montant"]) .'</td>';
                    echo '<td>par ' . $paiement["type_paiement"] . '</td>';
                    echo '<td>le ' . $paiement["date_paiement"] . '</td>';

                    echo '</tr>';
                }

                if(!$paiement_existant) {
                    echo '<tr>Il n\'y a pas encore de paiement</tr>';
                }
                elseif (mysqli_fetch_array($db->query("SELECT est_payee FROM commande WHERE id_commande=".$_GET['id_commande']))['est_payee']==1){
                    echo '<tr>La commande a été totalement réglée.</tr>';
                }


                ?>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col"><?php $commande->afficherArticles(); ?></div>
    </div>
</div>


</html>