<?php
include("../inc/fonction.php");
session_start();

$nom_objet = $_POST['nom_objet'];
$id_categorie = $_POST['id_categorie'];
$id_membre = $_SESSION['id']; 

$uploadDir = '../uploads/';
$maxSize = 10 * 1024 * 1024; 
$allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png'];
$defaultImage = 'defaut.png'; 

$cheminsImages = [];


if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
    $images = $_FILES['images'];

    for ($i = 0; $i < count($images['name']); $i++) {
        $tmp = $images['tmp_name'][$i];
        $size = $images['size'][$i];
        $name = $images['name'][$i];

        if (!file_exists($tmp)) continue;

        // Vérifie MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tmp);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMimeTypes)) {
            die("Fichier non autorisé : $name");
        }

        if ($size > $maxSize) {
            die("Image trop grande : $name (max " . ($maxSize / 1024 / 1024) . " Mo)");
        }

        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $base = pathinfo($name, PATHINFO_FILENAME);
        $newName = $base . '_' . uniqid() . '.' . $ext;
        $path = $uploadDir . $newName;

        if (move_uploaded_file($tmp, $path)) {
            $cheminsImages[] = $newName; 
        }
    }
}


if (count($cheminsImages) === 0) {
    $cheminsImages[] = $defaultImage;
}

$conn = bdconnect(); 


$requete = "INSERT INTO projet_final_objet (nom_objet, id_categorie, id_membre) VALUES ('%s', %d, %d)";
$requete = sprintf($requete, 
                   mysqli_real_escape_string($conn, $nom_objet),
                   intval($id_categorie),
                   intval($id_membre));

if (!mysqli_query($conn, $requete)) {
    die("Erreur lors de l'insertion de l'objet: " . mysqli_error($conn));
}

$id_objet = mysqli_insert_id($conn);


foreach ($cheminsImages as $i => $nom_image) {
    $requete = "INSERT INTO projet_final_images_objet (id_objet, nom_image) VALUES (%d, '%s')";
    $requete = sprintf($requete, 
                       intval($id_objet),
                       mysqli_real_escape_string($conn, $nom_image));
    
    if (!mysqli_query($conn, $requete)) {
        die("Erreur lors de l'insertion de l'image: " . mysqli_error($conn));
    }
}

header("Location: liste.php");
exit();
?>