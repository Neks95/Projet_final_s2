<?php
include("../inc/fonction.php");
session_start();

if (!isset($_SESSION['id'])) {
    header("location:../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Objet non spécifié.");
}

$id_objet = intval($_GET['id']);

if (!estDisponible($id_objet)) {
    die("Cet objet est actuellement indisponible.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duree = isset($_POST['duree']) ? (int) $_POST['duree'] : 0;

    if ($duree < 1 || $duree > 30) {
        $erreur = "Durée invalide (entre 1 et 30 jours).";
    } else {
        $date_emprunt = date('Y-m-d');
        $date_retour = date('Y-m-d', strtotime("+$duree days"));

        Emprunter($id_objet, $_SESSION['id'], $date_emprunt, $date_retour);

        header("Location: liste.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emprunter un objet</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4">Définir la durée d'emprunt</h3>
        <?php if (isset($erreur)) { ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php } ?>
        <form method="post">
            <div class="mb-3">
                <label for="duree" class="form-label">Durée (en jours)</label>
                <input type="number" class="form-control" name="duree" id="duree" min="1" max="30" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Valider l'emprunt</button>
        </form>
    </div>
</body>
</html>
