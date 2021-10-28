<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">
    </head>
    <body background="#EDE7D2">

    <a href='accueil.php?deconnexion=true'><span>Déconnexion</span></a>
            
            <!-- tester si l'utilisateur est connecté -->
            <?php
                session_start();
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      $_SESSION[] = array();
                      session_destroy();
                      header("Location:accueil?deconnexion=1.php");
                   }
                }
                else if(($_SESSION['login']==='ok') || (isset($_GET['deconnexion']))){
                    $connexion = $_GET['deconnexion'];
                    if ($connexion == 1) {
                        $pseudo = $_SESSION['pseudo'];
                        // afficher un message
                        echo "<br>Bonjour $pseudo, vous êtes connectés";
                    }
                }
            ?>
    </body>
</html>