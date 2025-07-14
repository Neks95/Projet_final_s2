<?php 
include("../inc/fonction.php");
session_start();

$nom = $_POST['nom'];
$dtn = $_POST['dtn'];
$email = $_POST['mail'];
$genre = $_POST['genre'];
$defaut = $_POST['defaut'];
$ville = $_POST['ville'];
$mdp = $_POST['mdp'];

insert_membre($email, $mdp, $nom, $dtn, $ville, $genre, $defaut);
$id = getId($email);
$id = getId($email);
$idd = $id['id_membre'];
$_SESSION['id'] = $idd;

header("location:liste.php");
?>