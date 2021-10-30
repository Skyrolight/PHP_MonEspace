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
        <div class="container">
            

            <div class="page">
                <div class="sujet">
                    <div class="grille">
                        <?php
                            require_once('connexion.php');
                            $requete = $objPdo->query("SELECT COUNT(*) FROM sujet;");
                            $resultat = $requete->fetchColumn();
                            $valeur = $resultat;
        
                            $tab[] = 0;
                            for ($i=0; $i < $valeur ; $i++) { 
                                $tab[$i] = $i++;
                            }

                            foreach ($tab as $line) {
                                $line++;
                                $requete = $objPdo->prepare("SELECT `titresujet`,`textesujet`,`datesujet` FROM sujet WHERE `idsujet`=(?);");
                                $requete->bindValue(1, $line, PDO::PARAM_INT);
                                $requete->execute();
                                $res = $requete->fetch();
                                $titre = $res['titresujet'];
                                $texte = $res['textesujet'];
                                $date = $res['datesujet'];
                                echo $titre;
                                echo $texte;
                                echo $date;
                            }

                        ?>
                        
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>