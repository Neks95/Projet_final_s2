<?php
include("../inc/fonction.php");
session_start();
$id_objet = $_GET['id'];
$objet = getDetail($id_objet);
$images = getImages($id_objet);
$emprunts = getEmprunt($id_objet);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $objet['nom_objet'] ?> - Détails</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../asset/style.css">

</head>
<body class="bg-light">
    <div class="container py-4">
        <a href="liste.php" class="btn btn-light mb-4">
            <i class="fas fa-arrow-left me-2"></i>Retour
        </a>

        <div class="product-container p-4">
            <div class="row">
                <div class="col-md-6">
                    <?php if (!empty($images)): ?>
                        <img src="../uploads/<?= $images[0]['nom_image'] ?>" 
                             class="main-image rounded mb-3" 
                             alt="<?= $objet['nom_objet'] ?>">
                        
                        <div class="thumbnail-container">
                            <?php foreach ($images as $image): ?>
                                <img src="../uploads/<?= $image['nom_image'] ?>" 
                                     class="thumbnail"
                                     onclick="this.parentNode.previousElementSibling.src=this.src">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <img src="../uploads/defaut.png" class="main-image rounded" alt="Image par défaut">
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <h1 class="mb-3"><?= $objet['nom_objet'] ?></h1>
                    <span class="badge badge-category mb-4"><?= $objet['nom_categorie'] ?></span>

                    <div class="owner-info">
                        <img src="../uploads/<?= $objet['image_profil'] ?? 'default-profile.jpg' ?>" 
                             class="owner-avatar" 
                        <div>
                            <h5 class="mb-1"><?= $objet['nom'] ?></h5>
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i><?= $objet['ville'] ?>
                            </small>
                        </div>
                    </div>

                    <h4 class="mt-4 mb-3"><i class="fas fa-history me-2"></i>Historique</h4>
                    <?php if (empty($emprunts)): ?>
                        <p class="text-muted">Aucun emprunt </p>
                    <?php else: ?>
                        <?php foreach ($emprunts as $emprunt): ?>
                            <div class="history-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong><?= $emprunt['nom'] ?></strong>
                                        <div class="text-muted small">
                                            Emprunté le <?= date('d/m/Y', strtotime($emprunt['date_emprunt'])) ?>
                                        </div>
                                    </div>
                                    <?php if (empty($emprunt['date_retour'])): ?>
                                        <span class="badge bg-warning">En cours</span>
                                    <?php else: ?>
                                        <div class="text-muted small">
                                            Rendu le <?= date('d/m/Y', strtotime($emprunt['date_retour'])) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>