<?php
include("../inc/fonction.php");
session_start();
$filtre = isset($_GET['filtre']) ? intval($_GET['filtre']) : 0;
$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$dispo = isset($_GET['dispo']);
$resultat = afficher0bjet($filtre, $nom, $dispo);

$cat = getCategorie();

$emprunts = getMesEmprunt($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objets à emprunter</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style.css">

</head>

<body>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Objets disponibles</h1>
            <p class="text-muted">Trouvez l'objet dont vous avez besoin</p>
        </div>
        <br>
        <h3>rechercher</h3>

   <form action="liste.php" method="GET" class="p-3 shadow rounded bg-light mb-4">
    <div class="row g-3">
        <div class="col-md-4">
            <label for="filtre" class="form-label">Catégorie</label>
            <select name="filtre" id="filtre" class="form-select">
                <option value="0">Toutes</option>
                <?php foreach ($cat as $c) { ?>
                    <option value="<?= $c['id_categorie'] ?>" <?= ($filtre == $c['id_categorie']) ? 'selected' : '' ?>>
                        <?= $c['nom_categorie'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="nom" class="form-label">Nom de l’objet</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= $_GET['nom'] ?? '' ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="dispo" id="dispo" <?= isset($_GET['dispo']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="dispo">
                    Uniquement disponibles
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success mt-3 w-100">Rechercher</button>
</form>



        <!-- filtre v1 -->
        <!-- <h3>Filtrer les objets</h3>
        <form action="liste.php" method="get">
            <select class="form-select" aria-label="Default select example" name="filtre">
                <option value="0">tous</option>
                <?php foreach ($cat as $c) { ?>
                    <option value="<?php echo $c['id_categorie'] ?>" <?php echo ($filtre == $c['id_categorie']) ? 'selected' : ''; ?>>
                        <?php echo $c['nom_categorie'] ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" class="btn btn-success mt-3">Filtrer</button>
        </form> -->

        <a href="upload.php"><button type="button" class="btn btn-dark mt-3">Ajouter un objet</button></a>
        <br>
        <br>

        <div class="container">
            <h2>liste des objets empruntes</h2>
            <?php foreach ($emprunts as $e) { ?>
                <h5 class="text-muted fs-5"><?php echo $e['nom_objet']?></h5>
                <a href="rendre.php?id=<?php echo $e['id_objet']?>"><button type="button" class="btn btn-success mt-3">Rendre l'objet</button></a>

               
            <?php } ?>

        </div>

        <div class="row g-4 mt-5">
            <?php foreach ($resultat as $res) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="fiche.php?id=<?php echo $res['id_objet']; ?>" class="card-link">
                        <div class="card shadow-sm h-100 clickable-card">
                            <img src="../uploads/<?php echo ($res['nom_image'] ?? 'default.jpg'); ?>" class="card-img-top"
                                alt="<?php echo ($res['nom_objet']); ?>">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo ($res['nom_objet']); ?></h5>
                                <p class="card-text mb-2">
                                    <?php echo ($res['nom_categorie']); ?>
                                </p>

                                <p class="card-text mb-3">
                                    <strong><?php echo ($res['nom']); ?></strong>
                                </p>

                                <div class="mt-auto">
                                    <?php if (!empty($res['date_retour'])) { ?>
                                        <span class="badge bg-danger w-100">
                                            Disponible le <?php echo ($res['date_retour']); ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge w-100">
                                           <button class="btn-secondary"><a href="emprunt.php?id=<?php echo $res['id_objet']; ?>">Emprunter</a></button>
                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>