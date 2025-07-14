<?php 
include("../inc/fonction.php");
session_start();

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$id = getId($email);
$idd = $id['id_membre'];
$_SESSION['id'] = $idd;

verif($email,$mdp);

?>