<html>
<?php
session_start();
require_once('connexion.php');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_GET['Titre'] ?> - MonEspace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="accueil.css">
</head>

<body style="min-width: 1250px;">
    <nav class="navbar" style="position: sticky;top: 0;">
        <div id="titreSite">
            <a href="accueil.php" style="text-decoration: none;">MonEspace</a>
        </div>
        <div id="recherche">
            <form name="search" action="rechercher.php" method="post" style="margin-bottom: 0px;">
                <input type="text" id="site-search" name="barRecherche" placeholder="Rechercher">
                <input type="submit" id="btSearch" name="btSearch" value="Rechercher">
            </form>
        </div>
        <div id="connecter">
            <?php
            if (isset($_GET['deconnexion'])) {
                if ($_GET['deconnexion'] == 'true') {
                    $_SESSION[] = array();
                    session_destroy();
                    header("Location: accueil.php?deconneted=true");
                }
            } else if (isset($_SESSION['login'])) {
                if (($_SESSION['login']) === 'ok') {
                    $pseudo = $_SESSION['pseudo'];
            ?>
                    <div id="blockConnecter">
                        <p class="deconnexionP">
                            <a href="accueil.php?deconnexion=true" class="deconnexionText">Déconnexion</a>
                        </p>
                        <?php
                        echo '<p class="bonjourConnexion">Bonjour ' . $pseudo . ', vous êtes connecté</p>';
                        ?>
                    </div>
                    <div id="createArticle">
                        <?php
                            $requete = $objPdo->prepare('SELECT idsujet FROM sujet, redacteur WHERE sujet.idredacteur = redacteur.idredacteur 
                                AND sujet.titresujet = ? 
                                AND redacteur.pseudo = ?;');
                            $requete->bindValue(1, $_GET['Titre'], PDO::PARAM_STR);
                            $requete->bindValue(2, $pseudo, PDO::PARAM_STR);
                            $requete->execute();
                            $val = $requete->fetch(PDO::FETCH_ASSOC);

                            $id = $val['idsujet'];
                            if ($val != 0) {
                            ?>
                                <a href="suppArticle.php?id=<?php echo $id ?>" class="createArticleLien">Supprimer article</a>
                            <?php
                            }
                        ?>
                    </div>
            <?php
                }
            } else echo '<a href="seconnecter.php" class="createArticleLien">se connecter</a>';
            ?>
        </div>
    </nav>

    <?php
    if (isset($_POST['Submit'])) {
        if (!isset($_POST['reponse']) or strlen(trim($_POST['reponse'])) == 0) {
            echo '<script>alert("Veuillez saisir une réponse");</script>';
        }
    }

    if (isset($_GET['FromCreateArticle'])) {
        if (($_GET['FromCreateArticle']) == 'true') {
            $title = $_GET['Titre'];
        }
    }

    if (isset($_SESSION['login'])) {

        $erreur = array();
        $date = date('Y/m/d', time());

        $reqredac = 'SELECT idredacteur from redacteur where pseudo = :psd';
        $selectredac = $objPdo->prepare($reqredac);
        $selectredac->execute(array('psd' => $pseudo));
        foreach ($selectredac as $row3) {
            $redacrep = $row3['idredacteur'];
        }
    }

    $select = 'SELECT * from sujet where titresujet = :titrechoisi';
    $result  = $objPdo->prepare($select);
    $result->execute(array('titrechoisi' => $_GET['Titre']));
    $title = $_GET['Titre'];
    ?>
        <div class="content">
            <article class="articleReponse">
        <?php

    foreach ($result as $row) {
        $result0 = $objPdo->query('SELECT pseudo FROM redacteur WHERE idredacteur = ' . $row['idredacteur']);
        foreach ($result0 as $row0) {
            $nomredac = $row0['pseudo'];
        }
            echo "<h1>" . $row['titresujet'] . "</h1>"; 
            echo '<hr class="linebreak"> </hr>';
            echo '<div class="nomSujetMain">'. $nomredac . "</div>";
            echo '<div class="dateSujetMain">'. "le " . $row['datesujet'] . "</div>";
            echo '<div class="textSujetMain">'. "</br>" . "</br>". $row['textesujet'] . "</div>";
        $result2 = $objPdo->query('SELECT * FROM reponse WHERE idsujet = ' . $row['idsujet'] . ' ORDER BY daterep DESC');
        foreach ($result2 as $row2) {

            $result3 = $objPdo->query('SELECT * FROM redacteur WHERE idredacteur = ' . $row2['idredacteur']);
            foreach ($result3 as $row3) {
                $redacteur = $row3['pseudo'];
            }
            
            echo '<div class="nomSujetPage">'. $redacteur . "</div>";
            echo '<div class="dateSujetPage">'. "le " . $row2['daterep'] . "</div>";
            echo '<div class="textSujetPage">'. "</br>" . "</br>". $row2['textereponse'] . "</div>"; 
        }
    }
    echo "</article>";

    if (!isset($_POST['reponse']) or strlen(trim($_POST['reponse'])) == 0) {
        $erreur['reponse'] = 'saisie obligatoire du texte de la réponse';
    }
    if (count($erreur) == 0) { //Il n'y a pas d'erreur : on peut insérer dans la BDD


        $req2 = 'INSERT INTO reponse (idreponse, idsujet, idredacteur, daterep, textereponse) VALUES(:idrep,:idsuj,:idredac,:daterep,:texte)';
        $insert2 = $objPdo->prepare($req2);

        $insert2->execute(array(
            'idrep' => 0,
            'idsuj' => $row['idsujet'],
            'idredac' => $redacrep,
            'daterep' => $date,
            'texte' => $_POST['reponse']
        ));
        header("location.href='viewArticle.php?Titre=<?php echo $title ?>';");
    }
    ?>
        <article class="reponse">
    <?php
    if (isset($_SESSION['login'])) {
        if ($_SESSION['login'] === 'ok') {
        ?>
            
                <h1>Répondre à cet article</h1>

                <form name='addrep' action='viewArticle.php?Titre=<?php echo $title ?>' method='post'>
                    <textarea id="reponse" name="reponse" rows="30" cols="40" placeholder="Ecrire ici..."></textarea> </br>
                    <input name="Submit" id="btnInscArticle" type="submit" /> </br>
                </form>
    <?php
        }
    }

    ?>
    <input type="button" value="Retour" id="btnRetourArticle" onclick="location.href='accueil.php'">
    </article>
    </div>
</body>

</html>