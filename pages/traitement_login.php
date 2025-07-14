<?php 
include("../inc/fonction.php");
session_start();

$email = $_POST['email'];
$mdp = $_POST['mdp'];

verif($email,$mdp);

?>