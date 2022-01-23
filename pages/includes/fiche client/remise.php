<?php
/** @var $client Client */

require_once '../lib/Utils.php';
?>

<h4>Ajouter une remise</h4>

<p>Remise future : <span class="fw-bold"><?php echo formaterPrix($client->remise_future)?></span>.
    <br>
   Cette remise sera utilisée lors du prochain paiement.
</p>

<form method="get" action="../lib/ajouter_remise.php">

    <input hidden name="id_client" value="<?php echo $client->id ?>">

    <div class="mb-3">
        <label class="form-label">Montant de la remise</label>
        <input type="number" name="montant" required class="form-control">
    </div>

    <input type="submit" class="btn btn-primary" value="Ajouter">
</form>