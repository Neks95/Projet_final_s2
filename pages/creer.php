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
        <div class="head">
            <h1>Emprunt</h1>
        </div>
        <form action="traitement_creer.php" method="post">
            <h2>Creer un compte</h2>
            <p><input type="text" name="nom" placeholder="Nom" required></p>
            <p><input type="date" name="dtn" placeholder="date de naissance" required></p>
            <p><input type="email" name="mail" placeholder="Email" required></p>
            <p><select name="genre">
                    <option value="M">Homme</option>
                    <option value="F">Femme</option>
                </select></p>
            <p><input type="hidden" name="defaut" value="../assets/image/defaut.jpg"></p>
            <p><input type="text" name="ville" placeholder="ville" required></p>
            <p><input type="password" name="mdp" placeholder="Mot de passe" required></p>
            <?php if (isset($_GET['error'])) { ?>
                <p style="color: red;">Email deja utilise !</p>
            <?php } ?>
            <input type="submit" value="S'inscrire">
        </form>
    </div>
</body>

</html>