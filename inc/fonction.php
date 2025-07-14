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

function afficher0bjet($filtre)

{
    $objet = [];
    if ($filtre == 0) {
        $requete = "SELECT * FROM v_liste_objet";
        $result = mysqli_query(bdconnect(), $requete);
        while ($ligne = mysqli_fetch_assoc($result)) {
            $objet[] = $ligne;

        }
    }
    else {
        $requete = "SELECT * FROM v_liste_objet WHERE id_categorie = '%s'";
        $requete = sprintf($requete,$filtre);
        $result = mysqli_query(bdconnect(), $requete);
        while ($ligne = mysqli_fetch_assoc($result)) {
            $objet[] = $ligne;

        }
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
?>