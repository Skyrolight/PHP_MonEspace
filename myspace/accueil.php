<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">

        <?php
            session_start(); 
            require_once("connexion.php"); 
            
            if ($_SESSION['utilisateur'] !== "") {
                $utilisateur = $_SESSION['utilisateur'];
            }
        ?>

    </head>
    <body>

        <script type="text/javascript" src="connexion.js">
            if (connexionUser.utilisateur === "utilisateur") {

                <a href="moncompte.php"><?php $utilisateur?></a>
            } else {
                <a href="seconnecter.php">se connecter</a>
            }
        </script>
        
    </body>
</html>