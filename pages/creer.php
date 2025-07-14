<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <style>
        body {
              background-color:rgb(222, 223, 224);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: rgb(33, 34, 36);
            color: white;
            padding: 2rem;
            border-radius: 1rem;
            width: 100%;
            max-width: 450px;
        }

        .form-control {
            margin-bottom: 1rem;
        }

       

        h2, h1 {
            text-align: center;
        }

        .btn-custom {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Emprunt</h1>
        <form action="traitement_creer.php" method="post">
            <h2>Créer un compte</h2>

            <input type="text" name="nom" class="form-control" placeholder="Nom" required>
            <input type="date" name="dtn" class="form-control" required>
            <input type="email" name="mail" class="form-control" placeholder="Email" required>
            <select name="genre" class="form-control" required>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
            </select>
            <input type="hidden" name="defaut" value="../assets/image/defaut.jpg">
            <input type="text" name="ville" class="form-control" placeholder="Ville" required>
            <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>

            <?php if (isset($_GET['error'])) { ?>
                <p class="text-danger text-center">Email déjà utilisé !</p>
            <?php } ?>

            <button type="submit" class="btn btn-outline-light btn-custom ">S'inscrire</button>
        </form>
    </div>
</body>

</html>
