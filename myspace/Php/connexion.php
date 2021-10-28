<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />

    <title>Se connecter</title>
</head>

<body>

    <?php

    if (isset($_GET['erreur_connect'])) {

        $erreur = htmlspecialchars($_GET['erreur_connect']);

        switch ($erreur) {
            case 'fail_mdp':
    ?>
                <div>
                    <strong>Erreur de mot de passe</strong> Réessayez !
                </div>
            <?php
                break;

            case 'pseudo_inexistant':

            ?>
                <div>
                    <strong>Pseudo inexistant</strong> Veuillez créer un compte ou retaper un pseudo valide !
                </div>

    <?php
                break;
        }
    }
    ?>

    <form action="gestion_connexion.php" method="post">
        <h2>Connexion</h2>

        <div>
            <input type="text" name="user" placeholder="Pseudo">
        </div>

        <div>
            <input type="password" name="mdp" placeholder="Mot de passe">
        </div>

        <div>
            <button type="submit" class="btn">Connexion</button>
        </div>

    </form>
    <p><a href="inscription.php">Inscription</a></p>
    </div>

</body>

</html>