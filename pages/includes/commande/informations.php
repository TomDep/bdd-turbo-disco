<?php
/** @var $commande Commande */
?>

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
                break;

            case StatutCommande::en_cours:
                echo "<a href='../lib/changer_statut_commande.php?id_commande=". $commande->getId() ."&statut_actuel=". $commande->recupererStatus() ."' class='btn btn-success me-3'>Valider que la commande a bien été livrée</a>";
                echo '<a href="../lib/annuler_commande.php?id_commande='. $commande->getId() .'" class="btn btn-danger me-3">Annuler la commande</a>';

                if(!$commande->payee){
                    echo '<a href="generer_facture.php?id_commande='. $commande->getId() .'" class="btn btn-outline-secondary me-3">Créer une facture</a>';
                }

                break;

            case StatutCommande::annulee:
                echo '<a href="../lib/restaurer_commande.php?id_commande='. $commande->getId() .'" class="btn btn-primary me-3">Restaurer la commande</a>';

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
            <tbody>
            <?php
            // Récupération de tous les paiement liés à cette commande
            $req = "SELECT id_type_paiement, type_paiement, montant, date_paiement FROM paiement NATURAL JOIN typepaiement WHERE id_commande = " . $commande->id;
            $result = $db->query($req);
            $total_paye = 0;


            while($paiement = $result->fetch_assoc()) {
                $total_paye += $paiement["montant"];

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

            ?>
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="fw-bold">
                    <?php
                    if($total_paye == 0) {
                        echo 'Il n\'y a pas encore eu de paiement, il reste <span class="fw-bold">' . formaterPrix($commande->calculerPrixTotal()) . ' a payer (HT)</span>';
                    } else {
                        if($commande->payee) {
                            echo 'La commande a été complètement payée';
                        } else {
                            echo 'Il reste ' . formaterPrix($commande->calculerPrixRestant()) . ' HT a payer.';
                        }
                    }
                    ?>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="row mt-3">
    <div class="col"><?php $commande->afficherArticles(); ?></div>
</div>