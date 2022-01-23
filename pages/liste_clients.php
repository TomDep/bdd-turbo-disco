<!DOCTYPE html>
<?php
//paramètres de connexion à la base de données

    require_once '../lib/connexion.php';
    $db = creerConnexion();

?>

<html lang="fr">
<head>
    <title>Liste des fiches clients</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<?php
require_once "../lib/Client.php";
?>

<div class="container p-5">

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liste clients</li>
        </ol>
    </nav>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du client</th>
                <th>Adherent</th>
                <th>Grade</th>
                <th></th>
            </tr>
        </thead>
        <tbody
    <?php
    $clients = creerListeClients();

    foreach ($clients as $client) {
    ?>
            <tr>
                <th><?php echo $client->id ?></th>
                <td><?php echo $client->getNomPrenom() ?></td>
                <td><?php echo ($client->adherant) ? '<i class="bi bi-check"></i>' : '<i class="bi bi-x"></i>' ?></td>
                <td><?php echo $client->grade ?></td>
                <td><a href="fiche_client.php?id_client=<?php echo $client->id ?>">Voir la fiche</a></td>
            </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
</div>

</body>
</html>
