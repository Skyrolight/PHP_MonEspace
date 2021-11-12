    
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mot de passe oublié</title>
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
            <h1 class="text-center">Mot de passe oublié</h1>
            <div class="colonneText">
                <form id="form" name="formulaire" action="gestionMdp.php" method="post">
                    <div class="ChampsMail">
                        <div class="ChampsMailText">
                            <label class="ChampsMailLabelText" style="padding: 0px 0px 7px 20px;">Adresse mail</label>
                        </div>
                        <div id="ChampsInsc">
                            <input id="inputChamps" type="text" size="20" name="adresse" placeholder="Entrer votre mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Valider" name="Valider" id="btnInsc">
                        <input type="button" value="Retour"  name="Retour" id="btnRetour" onclick="location.href='accueil.php'">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>