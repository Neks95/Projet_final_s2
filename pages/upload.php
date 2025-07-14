<?php

include("../inc/fonction.php"); 

$categories = getCategorie(); 
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
        <h2 class="mb-3 text-center">Ajouter un objet</h2>
        <form action="traitement_upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nom de l'objet</label>
                <input type="text" name="nom_objet" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Catégorie</label>
                <select name="id_categorie" class="form-control" required>
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?= $cat['id_categorie'] ?>"><?= $cat['nom_categorie'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Images (la première sera l’image principale)</label>
                <input type="file" name="images[]" multiple class="form-control" accept="image/*" >
            </div>
            <button type="submit" class="btn btn-success w-100">Ajouter l'objet</button>
        </form>
    </div>
</body>
</html>
