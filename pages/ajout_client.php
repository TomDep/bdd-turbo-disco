<!DOCTYPE html>
<?php
    require_once "../lib/connexion.php";
    $db = creerConnexion();
?>
<html lang="fr">
<head>
    <title>Ajouter un client</title>
    <?php  include("../templates/links.php");  ?>
</head>
<body>
<?php  include("../templates/menu.php");  ?>

<div class="p-5 border rounded container">
    <h2 class="mb-3">Ajout d'un nouveau client</h2>
    <form action="../lib/ajouter_client.php" method="POST">
        <div class="row mb-3">
            <div class="col">
                <input class="form-control mb-1" type="text" placeholder="Nom..." name="nom" required>
                <input class="form-control" type="text" placeholder="Prenom..." name="prenom" required>
            </div>
            <div class="col-auto">
                <select name="grade" class="form-select">
                    <?php
                    $req = "SELECT intitule_grade, id_grade FROM grade ORDER BY id_grade";
                    $rep = $db->query($req);

                    while($g = $rep->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $g["id_grade"]; ?>"><?php echo $g["intitule_grade"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-auto">
                <div class="form-check form-switch">
                    <label class="form-check-label">Adherent</label>
                    <input type="checkbox" class="form-check-input" role="switch" name="adherent">
                </div>
            </div>
        </div>

        <h5>Contacts</h5>

        <div class="row mb-3">
            <div class="col">
                <input class="form-control mb-2" type="email" placeholder="E-mail..." name="email" required>
                <input class="form-control" type="text" placeholder="Numero de telephone" name="numero_tel" required>
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="Facebook..." name="facebook" required>
            </div>
            <div class="col">
                <input class="form-control" type="text" placeholder="Instagram..." name="instagram" required>
            </div>
        </div>

        <h5>Adresse</h5>

        <div class="row">
            <div class="col-auto">
                <input class="form-control" type="number" placeholder="Numero de rue..." name="numero" required>
            </div>
            <div class="col-auto">
                <input class="form-control" type="text" placeholder="Nom de rue..." name="rue" required>
            </div>
            <div class="col-auto">
                <input class="form-control" type="text" placeholder="Ville..." name="ville" required>
            </div>
            <div class="col-auto">
                <input class="form-control" type="number" placeholder="Code postal..." name="code_postal" required>
            </div>
        </div>

        <input class="btn btn-primary mt-3" type="submit" id='submit' value='Ajouter'>
    </form>
</div>
</body>
</html>
