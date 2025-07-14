<?php

include("../inc/fonction.php"); 

$id_objet = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un objet</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style.css">
<style>
    
</style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;"\>
    <div class="card p-4" style="width: 100%; max-width: 500px;">
        <h2 class="mb-3 text-center">Rendre un objet</h2>
        <form action="traitement_rendre.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>etat de l'objet</label>
                <select name="id_categorie" class="form-control" required>
                    <option value="0">ok</option>
                    <option value="1">Abime</option>
                </select>
            </div>
            <input type="hidden" name="ido" value="<?php echo $id_objet?>">
            <button type="submit" class="btn btn-success w-100">Rendre</button>
        </form>
    </div>
</body>
</html>
