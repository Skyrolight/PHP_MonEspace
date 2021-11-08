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
    <form action="gestion_inscription.php" method="post">
        <h2 class="text-center">Inscription</h2>

        <div id="ChampsInsc">
            <input type="text" name="mail" placeholder="Email">
        </div>

        <div id="ChampsInsc">
            <input type="text" name="conf_mail" placeholder="Confirmer Email">
        </div>

        <div id="ChampsInsc">
            <input type="text" name="nom" placeholder="Nom">
        </div>

        <div id="ChampsInsc">
            <input type="text" name="prenom" placeholder="Prenom">
        </div>

        <div id="ChampsInsc">
            <input type="text" name="pseudo" placeholder="Pseudo">
        </div>

        <div id="ChampsInsc">
            <input type="password" name="mdp" placeholder="Mot de passe">
        </div>

        <div id="ChampsInsc">
            <input type="password" name="conf_mdp" placeholder="Confirmer mot de passe">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="S'inscrire">
            <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
        </div>
    </form>
    </div>

</body>

</html>