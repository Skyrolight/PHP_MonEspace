<html>

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="accueil.css">

    <title>Inscription</title>
</head>

<body>
<nav class="navbar" style="height: 50px;">
                <div id="titreSite">
                    <a href="accueil.php">MonEspace</a>
                </div>
        </nav>

    <?php
    if (isset($_GET['erreur_inscript'])) {
        $erreur = htmlspecialchars($_GET['erreur_inscript']);

        switch ($erreur) {
            case 'err_conf':
    ?>
                <div class="erreur">
                    <strong>Erreur de confirmation</strong> Réessayez !
                </div>
            <?php
                break;

            case 'pseudo_existant':
            ?>
                <div class="erreur">
                    <strong>Pseudo déja existant</strong> Modifiez votre pseudo !
                </div>
            <?php
                break;

            case 'mq_infos':
            ?>
                <div class="erreur">
                    <strong>Manque d'informations</strong> Remplissez tous les champs !
                </div>
            <?php
                break;

            case 'champs_vides':
            ?>
                <div class="erreur">
                    <strong>Champs vides</strong> Remplissez tous les champs !
                </div>
    <?php
                break;
        }
    }
    ?>
    <div class="containerInsc"> 
        <h1 class="text-center">Inscription</h2>
        <div class="colonneText">
            <form id="formInscription" action="gestion_inscription.php" method="post">
                
                <div class="ChampsMail">
                    <div class="ChampsMailText">
                        <label class="ChampsMailLabelText" style="padding: 0px 0px 7px 20px;">E-mail</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="text" name="mail" placeholder="Email">
                    </div>
                </div>

                <div class="ChampsMail">
                    <div class="ChampsMailText">
                        <label class="ChampsMailLabelText">Confirmer votre E-mail</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="text" name="conf_mail" placeholder="Confirmer Email">
                    </div>
                </div>

                <div class="ChampsMail">
                    <div class="ChampsMailText">
                        <label class="ChampsMailLabelText">Nom</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="text" name="nom" placeholder="Nom">
                    </div>
                </div>

                <div class="ChampsMail">
                    <div class="ChampsMailText">
                        <label class="ChampsMailLabelText">Confirmer votre nom</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="text" name="prenom" placeholder="Prenom">
                    </div>
                </div>


                <div class="ChampsMail">
                    <div class="ChampsMailText">
                        <label class="ChampsMailLabelText">Pseudo</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="text" name="pseudo" placeholder="Pseudo">
                    </div>
                </div>

                <div class="ChampsMail">
                    <div class="ChampsMailText">
                            <label class="ChampsMailLabelText">Mot de passe</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="password" name="mdp" placeholder="Mot de passe">
                    </div>
                </div>

                <div class="ChampsMail">
                    <div class="ChampsMailText">
                                <label class="ChampsMailLabelText">Confirmer votre mot de passe</label>
                    </div>
                    <div id="ChampsInsc">
                        <input id="inputChamps" type="password" name="conf_mdp" placeholder="Confirmer mot de passe">
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" id="btnInsc" value="S'inscrire">
                    <input type="button" value="Retour" id="btnRetour" onclick="location.href='accueil.php'">
                </div>
            </form>
        </div>
    </div>

</body>

</html>