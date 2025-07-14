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
        }else {
            header("location: creer.php?error=1");
        }
    }

}

?>