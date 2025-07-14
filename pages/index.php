<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style.css">
    <style>
        body {
            height: 100vh;
            background-color: #a9adb1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border-radius: 1rem;
            background-color:rgb(33, 34, 36);
            color: white;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body>

    <div class="card text-center">
        <form action="traitement_login.php" method="post">
            <h2 class="fw-bold mb-3 text-uppercase">Login</h2>
            <p class="text-white-50">Connectez vous</p>

            <input type="email" class="form-control form-control-lg mb-3" placeholder="Email" name="mail">
            <input type="password" class="form-control form-control-lg mb-3" placeholder="Mot de passe" name="mdp">

            <?php if (isset($_GET['erreur'])) { ?>
                <h6 class="text-danger">Verifiez les informations</h6>
            <?php } ?>

            <button class="btn btn-outline-light btn-lg w-100 mb-3">Se
                connecter</button></a>
            <a href="creer.php">
                <p class="mt-4 mb-0 text-white-50">Vous n'avez pas de compte ?
                </p>
            </a>

        </form>

    </div>


</body>

</html>