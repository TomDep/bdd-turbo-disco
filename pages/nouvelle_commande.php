<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer une nouvelle commande</title>


    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<form action="../lib/creer_commande.php" method="post">
    <div>
        <label for="date">Date de passage</label>
        <input type="text" id="date" name="date">
    </div>
    <div>
        <label for="Client">Id client:</label>
        <input type="client" id="client" name="id_client">
    </div>
    <div>
        <label for="msg">Id paiement :</label>
        <textarea id="paiement" name="id_paiement"></textarea>
    </div>

    <div class="c100" id="submit">
        <input type="submit" value="Envoyer">
    </div>
</form>

</body>
</html>