<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Se connecter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <div id="container">
            <h1>Se connecter</h1>
            <!-- Connection -->
            <form name="formulaire" action="gestionSeConnecter.php" method="post">
                <p>Pseudo: <input type="text" size="20" name="pseudo" placeholder="Entrer votre pseudo"></p>
                <p>Mot de passe: <input type="password" size="20" name="mdp" placeholder="Entrer votre mot de passe"></p>
                <input type="submit" value="Valider" name="Valider" class="btn">
                <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
                </br> <a href="inscription.php">Je n'ai pas de compte</a>

                <?php
                if (isset($_GET['erreur'])) {
                    $erreur = $_GET['erreur'];
                    if ($erreur == 1) {
                        echo "<p style='color:red'>Pseudo ou mot de passe incorrect</p>";
                    }
                }
                ?>
            </form>
        </div>
    </body>
</html>