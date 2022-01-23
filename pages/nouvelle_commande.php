<?php
    session_start();

    unset($_SESSION["commande"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer une nouvelle commande</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="container p-5 mt-4 rounded shadow-lg">

    <h1>Création d'une nouvelle commande</h1>

    <hr class="w-50">
    <form autocomplete="off" method="GET" action="nouvelle_commande_articles.php">
        <label class="form-label">Sélectionner un client</label>
        <input type="Text" class="form-control" placeholder="Rechercher à partir du nom ou de l'id ..." list="clients" name="client_full">
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