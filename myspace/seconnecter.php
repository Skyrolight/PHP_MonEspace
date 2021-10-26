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
                session_start();
                    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
                        require_once("connexion.php"); 

                        $pseudo = mysqli_real_escape_string($objPdo, htmlspecialchars($_POST['pseudo']));
                        $pseudo = mysqli_real_escape_string($objPdo, htmlspecialchars($_POST['pseudo']));
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
            </form>
        </div>
    </body>
</html>