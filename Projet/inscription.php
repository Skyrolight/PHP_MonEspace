<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css" />

    <title>Inscription</title>
</head>

<body>

    <?php
    if (isset($_GET['erreur_inscript'])) {
        $erreur = htmlspecialchars($_GET['erreur_inscript']);

        switch ($erreur) {
            case 'err_conf':
    ?>
                <div>
                    <strong>Erreur de confirmation</strong> Réessayez !
                </div>
            <?php
                break;

            case 'pseudo_existant':
            ?>
                <div>
                    <strong>Pseudo déja existant</strong> Modifiez votre pseudo !
                </div>
            <?php
                break;

            case 'mq_infos':
            ?>
                <div>
                    <strong>Manque d'informations</strong> Remplissez tous les champs !
                </div>
            <?php
                break;

            case 'champs_vides':
            ?>
                <div>
                    <strong>Champs vides</strong> Remplissez tous les champs !
                </div>
    <?php
                break;
        }
    }
    ?>

    <form action="gestion_inscription.php" method="post">
        <h2 class="text-center">Inscription</h2>

        <div>
            <input type="text" name="mail" placeholder="Email">
        </div>

        <div>
            <input type="text" name="conf_mail" placeholder="Confirmer Email">
        </div>

        <div>
            <input type="text" name="nom" placeholder="Nom">
        </div>

        <div>
            <input type="text" name="prenom" placeholder="Prenom">
        </div>

        <div>
            <input type="text" name="pseudo" placeholder="Pseudo">
        </div>

        <div class="form-group">
            <input type="password" name="mdp" placeholder="Mot de passe">
        </div>

        <div class="form-group">
            <input type="password" name="conf_mdp" placeholder="Confirmer mot de passe">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="S'inscrire">
            <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
        </div>
    </form>

</body>

</html>