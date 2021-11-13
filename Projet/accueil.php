<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MonEspace</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">
    </head>
    <body style="min-width: 1250px;">
        
        <nav class="navbar" style="position: sticky;top: 0;">
            <div id="titreSite">
                <a href="accueil.php" style="text-decoration: none;">MonEspace</a>
            </div>
            <div id="recherche">
                <form name="search" action="rechercher.php" method="post">
                    <input type="text" id="site-search" name="barRecherche" placeholder="Rechercher">
                    <input type="submit" id="btSearch" name="btSearch" value="Rechercher">
                </form>
            </div>
            <div id="connecter">
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
                                ?>
                                <div id="blockConnecter">
                                    <p class="deconnexionP">
                                        <a href="accueil.php?deconnexion=true" class="deconnexionText">Déconnexion</a>
                                    </p>
                                    <?php
                                        echo '<p class="bonjourConnexion">Bonjour '. $pseudo .', vous êtes connecté</p>';
                                    ?>
                                </div>
                                <div id="createArticle">
                                    <a href="createArticle" class="createArticleLien">Créer un article</a>
                                </div>
                                <?php
                            }
                        } else echo '<a href="seconnecter.php" class="createArticleLien">se connecter</a>';
                ?>
            </div>
        </nav>

        <div class="container"> 
            <div class="page">
                <div class="sujet">
                    <div class="grille">
                        <?php
                            require_once('connexion.php');

                            if (isset($_GET['search'])) {
                                    $search = htmlspecialchars($_GET['search']);
                                    
                                    $requete = $objPdo->query("SELECT `titresujet`,`textesujet`,`datesujet` FROM sujet WHERE titresujet LIKE '%".$search."%' ;");
                                    $row = $requete->rowCount();
                                
                                    if($row==0) echo "Pas de titre contenant \"".$search."\"";
                                foreach ($requete as $line) {
                                    $titre = $line['titresujet'];
                                    $texte = $line['textesujet'];
                                    $date = $line['datesujet'];
                                ?>

                                <div id="Carte" style="cursor: pointer;" onclick="location.href='viewArticle.php?Titre=<?php echo $titre ?>';">
                                <?php
                                    echo '<div id="TitreGrille">
                                            <p id="titreText">'.$titre.'</p>
                                        </div>
                                        <div id="TexteGrille">
                                            <p id="parText">'.$texte.'</p>
                                        </div>
                                        <div id="DateGrille">
                                            <p id="dateText">'.$date.'</p>
                                        </div>
                                    </div>';
                                }  
                            }
                            else{
        
                                $requete = $objPdo->query("SELECT `titresujet`,`textesujet`,`datesujet` FROM sujet ;");
                                foreach ($requete as $line) {
                                    $titre = $line['titresujet'];
                                    $texte = $line['textesujet'];
                                    $date = $line['datesujet'];
                                ?>

                                <div id="Carte" style="cursor: pointer;" onclick="location.href='viewArticle.php?Titre=<?php echo $titre ?>';">
                                <?php
                                    echo '<div id="TitreGrille">
                                            <p id="titreText">'.$titre.'</p>
                                        </div>
                                        <div id="TexteGrille">
                                            <p id="parText">'.$texte.'</p>
                                        </div>
                                        <div id="DateGrille">
                                            <p id="dateText">'.$date.'</p>
                                        </div>
                                    </div>';
                                }
                            }
                            ?>
                    </div>
                </div>  
            </div>
        </div>
    </body>
</html>