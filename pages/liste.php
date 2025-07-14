<?php
include("../inc/fonction.php");
$resultat = afficher0bjet();
if (!isset($filtre)) {
    $filtre = 0;
}
else {
    $filtre = $_GET['filtre'];
}

$cat = getCategorie($filtre);
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

        <form action="liste.php" method="get">
            <select class="form-select" aria-label="Default select example">
                <option value="0">tous</option>
                <?php foreach ($cat as $c) { ?>
                    <option value="<?php echo $c['id_categorie']?>"><?php echo $c['nom_categorie']?></option>
                <?php } ?>
            </select>
        </form>
       
        
        
        <div class="row g-4 mt-5">
            <?php foreach ($resultat as $res) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <img src="../images/<?php echo ($res['image'] ?? 'default.jpg'); ?>" class="card-img-top"
                            alt="<?php echo ($res['nom_objet']); ?>">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo ($res['nom_objet']);?></h5>

                            <p class="card-text mb-2">

                                <?php echo ($res['nom_categorie']); ?>
                            </p>

                            <p class="card-text mb-3 ">
                                <strong> <?php echo ($res['nom']); ?></strong>

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
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>