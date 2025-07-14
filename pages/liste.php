<?php
include("../inc/fonction.php");
$filtre = isset($_GET['filtre']) ? intval($_GET['filtre']) : 0;
$resultat = afficher0bjet($filtre);
$cat = getCategorie();
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

        <form action="liste.php" method="GET" class="p-3 shadow rounded bg-light">
            <div class="form-group mb-3">
                <form action="resultat.php" method="GET" class="p-3 shadow rounded bg-light">
                    <div class="form-group mb-3">
                        <label for="departement" class="form-label">Categorie</label>
                        <select name="departement" id="departement" class="form-select">
                            <option value="0">tous </option>
                             <?php foreach ($cat as $c) { ?>
                        <option value="<?php echo $c['id_categorie'] ?>" <?php echo ($filtre == $c['id_categorie']) ? 'selected' : ''; ?>>
                        <?php echo $c['nom_categorie'] ?>
                        </option>
                      <?php } ?>
                           
                        </select>
                    </div>

        
                    <div class="form-group mb-3">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" class="form-control" name="nom">
                    </div>


                    <button type="submit" class="btn btn-secondary w-100">Rechercher</button>
                </form>
    




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
                                            Jusqu'au <?php echo ($res['date_retour']); ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="badge bg-success w-100">
                                            Disponible
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