<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer une nouvelle commande</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5 mt-4 rounded shadow-lg">

    <h4>Création d'une nouvelle commande</h4>

    <hr class="w-50">
    <form method="POST" action="nouvelle_commande_articles.php">
        <label class="form-label">Client (entrez le nom ou le prenom)</label>
        <input type="Text" class="form-control" list="clients" name="client_full">
        <datalist id="clients">
            <?php

            require_once '../lib/connexion.php';
            $req = "SELECT id_client, nom, prenom FROM client";
            $db = creerConnexion();

            $result = $db->query($req);
            while($line = $result->fetch_assoc()) {
                echo "<option value='" . $line["prenom"] . " " . $line["nom"] . " #" . $line["id_client"] . "'>" . $line["prenom"] . " " . $line["nom"] . "</option>";
            }
            ?>
        </datalist>

        <input type="submit" class="btn btn-primary mt-3" value="Suivant">
    </form>
</div>

</body>
</html>