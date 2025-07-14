
<?php
ini_set('display_errors', 1);


function bdconnect()
{
    static $connect = null;
    if ($connect === null) {
        // $connect = mysqli_connect('localhost','ETU004092','BjwSIVWn','db_s2_ETU004092');
            $connect = mysqli_connect('localhost','root','','projet_final');
        if (!$connect) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }
        mysqli_set_charset($connect, 'utf8mb4');
    } 
    return $connect;
}

?>