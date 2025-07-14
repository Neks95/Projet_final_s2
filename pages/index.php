<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>
<body>
    <div class="login">
        <div class="head"><h1>Emprunt</h1></div>
        <form action="traitement_login.php" method="post">
            <p><input type="Email" name="email" placeholder="Email" required ></p>
            <p><input type="password" name="mdp" placeholder="Mot de passe" required></p>
            <?php if (isset($_GET['erreur'])) {?>
                <p style="color: red;">Verifier les informations !</p>
            <?php }?>
            <input type="submit" value="Se connecter">
            <p><a href="creer.php">Vous n'avez pas de compte ?</a></p>
        </form>    
    </div>
</body>
</html>