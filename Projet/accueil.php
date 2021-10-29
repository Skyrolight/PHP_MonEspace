<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">
    </head>
    <body>
        
            <!-- tester si l'utilisateur est connecté -->
            <?php
                session_start();
                if(isset($_GET['deconnexion'])) { 
                   if($_GET['deconnexion']=='true') {  
                      $_SESSION[] = array();
                      session_destroy();
                      header("Location: accueil.php?deconneted=true");
                   }
                } else if(isset($_SESSION['login'])) {
                        if (($_SESSION['login']) === 'ok') {
                            $pseudo = $_SESSION['pseudo'];
                            // afficher un message
                            echo '<a href="accueil.php?deconnexion=true"><span>Déconnexion</span></a>';
                            echo "<br>Bonjour $pseudo, vous êtes connectés";
                        }
                    } else echo '<a href="seconnecter.php">se connecter</a>';
            ?>
    </body>
</html>