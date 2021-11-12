<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Se connecter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">

    </head>
    <body>
        <nav class="navbar" style="height: 50px;">
                <div id="titreSite">
                    <a href="accueil.php">MonEspace</a>
                </div>
        </nav>

        <div class="containerInsc">
            <h1 class="text-center">Se connecter</h2>
            <div class="colonneText">
                <!-- Connection -->
                <form id="formSeconnecter" name="formulaire" action="gestionSeConnecter.php" method="post">
                    <div class="ChampsMail">
                        <div class="ChampsMailText">
                            <label class="ChampsMailLabelText" style="padding: 0px 0px 7px 0px;">Pseudo</label>
                        </div>
                        <div id="ChampsInsc">
                            <input id="inputChamps" type="text" size="20" name="pseudo" placeholder="Entrer votre pseudo">
                        </div>
                    </div>
                    <div class="ChampsMail">
                        <div class="ChampsMailText">
                            <label class="ChampsMailLabelText" style="padding: 0px 0px 7px 0px;">Mot de passe</label>
                        </div>
                        <div id="ChampsInsc">
                            <input id="inputChamps" type="password" size="20" name="mdp" placeholder="Entrer votre mot de passe">
                        </div>
                    </div>

                    <input type="submit" value="Valider" name="Valider" class="btn">
                    <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
                    </br> <a href="inscription.php">Je n'ai pas de compte</a>
                </form>

                    <?php
                    if (isset($_GET['erreur'])) {
                        $erreur = $_GET['erreur'];
                        if ($erreur == 1) {
                            echo "<p style='color:red'>Pseudo ou mot de passe incorrect</p>";
                        }
                    }
                    ?>
            </div>
        </div>
    </body>
</html>