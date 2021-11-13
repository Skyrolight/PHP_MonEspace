<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Se connecter - MonEspace</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">

    </head>
    <body>
        <nav class="navbar" style="height: 50px;">
                <div id="titreSite">
                    <a href="accueil.php" style="text-decoration: none;">MonEspace</a>
                </div>
        </nav>

        <?php
            require_once('connexion.php');
            if (isset($_GET['FromArticle'])) {
                if ( ($_GET['FromArticle']) == 'true') {
                    session_start();
                    $article = $_GET['FromArticle'];
                    $titre = $_GET['Titre'];
                    session_destroy();
                }
            } else {
                $article = "";
                $titre = "";
            }
        ?>

        <div class="containerInsc">
            <h1 class="text-center">Se connecter</h1>
            <div class="colonneText">
                <form id="form" name="formulaire" action="gestionSeConnecter.php?Titre=<?php echo $titre ?>&FromArticle=<?php echo $article ?>" method="post">
                    <div class="ChampsMail">
                        <div class="ChampsMailText">
                            <label class="ChampsMailLabelText" style="padding: 0px 0px 7px 20px;">Pseudo</label>
                        </div>
                        <div id="ChampsInsc">
                            <input id="inputChamps" type="text" size="20" name="pseudo" placeholder="Entrer votre pseudo">
                        </div>
                    </div>
                    <div class="ChampsMail">
                        <div class="ChampsMailText">
                            <label class="ChampsMailLabelText">Mot de passe</label>
                        </div>
                        <div id="ChampsInsc">
                            <input id="inputChamps" type="password" size="20" name="mdp" placeholder="Entrer votre mot de passe">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Valider" name="Valider" id="btnInsc">
                        <input type="button" value="Retour"  name="Retour" id="btnRetour" onclick="location.href='accueil.php'">
                    </div>
                    <p> <a href="mdpMail.php" class="forgotmdp" >J'ai oublié mon mot de passe</a> </p>	
                </form>
                        <hr class="line">
                        <p> 
                            <input type="button" value="Créer un commpte"  name="CreateCompte" id="btnCreateCompte" onclick="location.href='inscription.php'">    
                        </p>

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