<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Se connecter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php
            if (isset($_POST['Valider'])) {
                $erreur = array();
                $valeur = array();

                if (!isset($_POST['pseudo']) or strlen(trim($_POST['pseudo'])) == 0) {
                    $erreur['nom']='Veuillez saisir votre pseudo';
                    echo '<script>alert("Veuillez saisir votre pseudo"); </script>';
                } else {
                    $valeur['pseudo'] = trim($_POST['pseudo']);
                }
                if (!isset($_POST['mdp']) or strlen(trim($_POST['mdp'])) == 0) {
                    $erreur['mdp']='Veuillez saisir votre mot de passe';
                    echo '<script>alert("Veuillez saisir votre mot de passe"); </script>';
                } else {
                    $valeur['mdp'] = trim($_POST['mdp']);
                }
                
                if(count($erreur)==0) {
                    require_once("connexion.php");
                    session_start();
                    $requete = $objPdo->prepare("SELECT count(*) FROM redacteur WHERE pseudo=? AND motdepasse=?;");
                    $requete->bindValue(1, $_POST['pseudo'], PDO::PARAM_STR);
                    $requete->bindValue(2, $_POST['mdp'], PDO::PARAM_STR);
                    $requete->execute();
                    $reponse = $requete->fetch(PDO::FETCH_ASSOC);
                    $val = $reponse['count(*)'];

                    if ($val!=0) {
                        $_SESSION['pseudo'] = $valeur['pseudo'];
                        $_SESSION['login'] = 'ok';
                        header('Location: accueil.php');
                    } else {
                        header('Location: seconnecter?erreur=1.php');
                    }
                }
            }
            $objPdo = NULL;
        ?>

    </head>
    <body>
        <div id="container">
            <h1>Se connecter</h1>
            <!-- Connection -->
            <form name="formulaire" action="seconnecter.php" method="post">
                <p>Pseudo: <input type="text" size="20" name="pseudo" placeholder="Entrer votre pseudo"></p>
                <p>Mot de passe: <input type="text" size="20" name="mdp" placeholder="Entrer votre mot de passe"></p>
                <input type="submit" value="Valider" name="Valider" class="btn">
                <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">

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