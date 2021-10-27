<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Se connecter</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

     

        <script language="javascript" type="text/javascript">
            function valider() {
                if (!(document.forms["formulaire"].pseudo.value))
                    alert("Pseudo manquant");
                else if (!(document.forms["formulaire"].mdp.value))
                    alert("Mot de passe manquant");
                else if ((document.forms["formulaire"].pseudo.value) && (document.forms["formulaire"].mdp.value)){
                    verifConnexionCompte();
                }
            }

            function verifConnexionCompte() {
                <?php 
                    $requete = $objPdo->prepare("SELECT count(*) FROM `redacteur` WHERE pseudo=? AND motdepasse=?");
                    $requete->bindValue(1, $_POST['pseudo']);
                    $requete->bindValue(2, $_POST['mdp']);
                    $requete->execute();
                    $val = $requete->fetch(PDO::FETCH_ASSOC);
                    
                    if($val == 1) {
                        $pseudo = $_POST['pseudo'];
                        $_SESSION['pseudo'] = $pseudo;
                        header('Location : accueil.php?pseudo='.$pseudo);
                    } else {
                        header('Location : seconnecter.php?erreur=1');
                    }
                ?>
            }
        </script>


    </head>
    <body>
        <div id="container">
            <h1>Se connecter</h1>
            <!-- Connection -->
            <form name="formulaire" action="seconnecter.php" method="post" onsubmit="return valider()">
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