<?php
/** @var $client Client */
/** @var $db mysqli */

require_once '../lib/Commande.php';

// Récupération de toutes les commandes du client
$commandes = [];
$req = "SELECT id_commande, id_status_commande FROM commande WHERE id_client = " . $client->id . " ORDER BY id_status_commande";
$result = $db->query($req);
while($commande = $result->fetch_assoc()) {
    $commandes[] = creerCommande($commande["id_commande"]);
}

?>

<h4>Commandes</h4>

<p>Il y a <span class="fw-bold"><?php echo count($commandes) ?></span> commandes</p>

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
        if(count($commandes) == 0) {
        echo '<tr><td>Il n\'y a pas de commandes</td></tr>';
        } else {
            foreach ($commandes as $commande) {
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
    <?php }} ?>
    </tbody>
</table>
