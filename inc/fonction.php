<?php
require("connexion.php");

function getMembre()
{
    $requete = "SELECT * FROM projet_final_membre";
    $result = mysqli_query(bdconnect(), $requete);

    $membre = [];

    while ($i = mysqli_fetch_assoc($result)) {
        $membre[] = $i;
    }

    return $membre;
}
function getId($email){
    $requete = "SELECT id_membre FROM projet_final_membre where email = '%s'";
   
    $requete = sprintf($requete,$email);
    $result = mysqli_query(bdconnect(),$requete);
    $ligne = mysqli_fetch_assoc($result);
    return $ligne;
}
function insert_membre($email, $mdp, $nom, $date, $ville, $genre, $pdp)
{
    $membre = getMembre();
    for ($i = 0; $i < count($membre); $i++) {
        if ($membre[$i]['email'] != $email) {
            $requete = "INSERT INTO projet_final_membre(email, mdp, nom, date_naissance, ville, genre, image_profil) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
            $requete = sprintf($requete, $email, $mdp, $nom, $date, $ville, $genre, $pdp);
            mysqli_query(bdconnect(), $requete);
        } else {
            header("location: creer.php?error=1");
        }
    }

}

function verif($email, $mdp)
{
    $requete = "SELECT * FROM projet_final_membre WHERE email = '%s' AND mdp = '%s'";
    $requete = sprintf($requete, $email, $mdp);
    $resultat = mysqli_query(bdconnect(), $requete);
    $user = mysqli_fetch_assoc($resultat);
    if (empty($user)) {
        header("location:index.php?erreur=1");
    } else {
        header("location:liste.php");
    }

}

function afficher0bjet($filtre, $nom = '', $dispo = false)
{
    $objet = [];
    $conn = bdconnect();
    $conditions = "WHERE 1=1";  // base toujours vraie

    if ($filtre > 0) {
        $conditions .= " AND id_categorie = " . intval($filtre);
    }

    if (!empty($nom)) {
        $nom_safe = mysqli_real_escape_string($conn, $nom);
        $conditions .= " AND nom_objet LIKE '%$nom_safe%'";
    }

    if ($dispo) {
        $conditions .= " AND date_retour IS NULL";
    }

    $requete = "SELECT * FROM v_liste_objet $conditions";
    $result = mysqli_query($conn, $requete);

    while ($ligne = mysqli_fetch_assoc($result)) {
        $objet[] = $ligne;
    }

    return $objet;
}


function getCategorie()
{
    $requete = "SELECT * FROM projet_final_categorie_objet";
    $result = mysqli_query(bdconnect(), $requete);
    $cat = [];
    while ($ligne = mysqli_fetch_assoc($result)) {
        $cat[] = $ligne;

    }
    return $cat;

}

function getDetail($id_objet){
    $conn = bdconnect();
    $requete = "SELECT o.*, c.nom_categorie, m.nom, m.ville, m.image_profil 
                FROM projet_final_objet o
                JOIN projet_final_categorie_objet c ON o.id_categorie = c.id_categorie
                JOIN projet_final_membre m ON o.id_membre = m.id_membre
                WHERE o.id_objet = %d";
    $requete = sprintf($requete, $id_objet);
    $result = mysqli_query($conn, $requete);
    return mysqli_fetch_assoc($result);
}


function getImages($id_objet) {
    $conn = bdconnect();
    $requete = "SELECT * FROM projet_final_images_objet WHERE id_objet = %d";
    $requete = sprintf($requete, $id_objet);
    $result = mysqli_query($conn, $requete);
    $images = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row;
    }
    return $images;
}

function getEmprunt($id_objet) {
    $conn = bdconnect();
    $requete = "SELECT e.*, m.nom, m.image_profil 
                FROM projet_final_emprunt e
                JOIN projet_final_membre m ON e.id_membre = m.id_membre
                WHERE e.id_objet = %d
                ORDER BY e.date_emprunt DESC";
    $requete = sprintf($requete, $id_objet);
    $result = mysqli_query($conn, $requete);
    $history = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $history[] = $row;
    }
    return $history;
}

function Emprunter($id_objet, $id_membre, $date_emprunt, $date_retour)
{
    $conn = bdconnect();
    $requete = "INSERT INTO projet_final_emprunt (id_objet, id_membre, date_emprunt, date_retour)
                VALUES (%d, %d, '%s', '%s')";
    $requete = sprintf($requete, $id_objet, $id_membre, $date_emprunt, $date_retour);
    mysqli_query($conn, $requete);
}

function estDisponible($id_objet)
{
    $conn = bdconnect();
    $requete = "SELECT * FROM projet_final_emprunt WHERE id_objet = %d AND CURDATE() <= date_retour";
    $requete = sprintf($requete, $id_objet);
    $result = mysqli_query($conn, $requete);
    return (mysqli_num_rows($result) == 0); // true si dispo
}

?>