<?php
require_once '../lib/Facture.php';
require_once '../lib/connexion.php';
require_once '../lib/Utils.php';
?>

<?php
/** @var $commande Commande */
?>

<div class="accordion" id="factures">

    <?php
        $db = creerConnexion();
        $req = "SELECT id_facture, id_client, frais_service, frais_livraison, remise, date_facturation FROM facture NATURAL JOIN commande WHERE id_commande = " . $commande->id;
        $reponse = $db->query($req);

        $factures = [];

        while($f = $reponse->fetch_assoc()) {
            $facture = new Facture($commande->id, $f["id_client"]);
            $facture->id = $f["id_facture"];
            $facture->remise = $f["remise"];
            $facture->frais_service = $f["frais_service"];
            $facture->frais_livraison = $f["frais_livraison"];
            $facture->date_facturation = $f["date_facturation"];

            // Récupération des articles de la facture
            $req = "SELECT id_article, intitule, quantite, prix_unitaire FROM itemcommande NATURAL JOIN article WHERE id_facture = " . $f["id_facture"];
            $reponse_articles = $db->query($req);

            while($a = $reponse_articles->fetch_assoc()) {
                $facture->articles[] = new ArticleCommande($a["id_article"], $a["intitule"], $a["quantite"], $a["prix_unitaire"], true);
            }

            $factures[] = $facture;
        }

        if(count($factures) == 0) {
            echo '<p>Il n\'y a pas encore de facture</p>';
        }

        foreach ($factures as $facture) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?php echo $facture->id?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $facture->id?>">
                        <span class="badge bg-primary ms-1 me-2">Facture #<?php echo $facture->id?></span> du <?php echo $facture->date_facturation ?>
                        • <?php echo formaterPrix($facture->TotalTTC()) ?>
                    </button>
                </h2>
                <div id="collapse<?php echo $facture->id?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $facture->id?>" data-bs-parent="#factures">
                    <div class="accordion-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Prix unité</th>
                                    <th scope="col">Prix total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($facture->articles as $article) {
                                echo '<tr>';

                                echo '<th>'. $article->id .'</th>';
                                echo '<td>'. $article->intitule .'</td>';
                                echo '<td>'. $article->quantite .'</td>';
                                echo '<td>'. formaterPrix($article->prix_unite) .'</td>';
                                echo '<td>'. formaterPrix($article->prix_unite * $article->quantite) . '</td>';

                                echo '</tr>';
                            }
                            ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="fw-bold">Frais de service</td>
                                    <td class="fw-bold"><?php echo '+ ' . formaterPrix($facture->frais_service); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="fw-bold">Frais de livraison</td>
                                    <td class="fw-bold"><?php echo '+ ' . formaterPrix($facture->frais_livraison); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="fw-bold">Remise</td>
                                    <td class="fw-bold"><?php echo '- ' . formaterPrix($facture->remise); ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                            <tr class="border-top">
                                <td></td>
                                <td></td>
                                <td></td>
                                <th class="fw-bold">Total</th>
                                <th class="fw-bold"><?php echo formaterPrix($facture->totalTTC()); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        <?php } ?>
</div>
