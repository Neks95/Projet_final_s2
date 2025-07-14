<?php 
include("../inc/fonction.php");
session_start();

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$id = getId($email);
$_SESSION['id']=$id;

verif($email,$mdp);

?>