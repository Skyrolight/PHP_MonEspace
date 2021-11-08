<html>

<head>
    <meta charset="utf-8">
    <title> a modifier</title>
    <link rel="stylesheet" href="projet.css">
</head>

<body>
    <?php
    session_start();
    require_once('connexion.php');

    if (isset($_GET['deconnexion'])) {
        if ($_GET['deconnexion'] == 'true') {
            $_SESSION[] = array();
            session_destroy();
            header("Location: accueil.php?deconnected=true");
        }
    } else if (isset($_SESSION['login'])) {
        if (($_SESSION['login']) === 'ok') {
            $pseudo = $_SESSION['pseudo'];

            // afficher un message
            echo '<a href="accueil.php?deconnexion=true"><span>Déconnexion</span></a>';
            echo "<br>Bonjour $pseudo, vous êtes connectés";

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
                <a href="suppArticle.php?id=<?php echo $id ?>">Supprimer article</a>
            <?php
            }
        }
    } else echo '<a href="seconnecter.php">se connecter</a>';

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
    echo "<article>";

    foreach ($result as $row) {
        $result0 = $objPdo->query('SELECT pseudo FROM redacteur WHERE idredacteur = ' . $row['idredacteur']);
        foreach ($result0 as $row0) {
            $nomredac = $row0['pseudo'];
        }

        echo
        "<h1>" . $row['titresujet'] . "</h1>" . "</br>"
            . $row['textesujet'] . "</br>"
            . "Ecrit par : " . $nomredac . "</br>"
            . "le " . $row['datesujet'] . "</br>";

        $result2 = $objPdo->query('SELECT * FROM reponse WHERE idsujet = ' . $row['idsujet']);
        foreach ($result2 as $row2) {

            $result3 = $objPdo->query('SELECT * FROM redacteur WHERE idredacteur = ' . $row2['idredacteur']);
            foreach ($result3 as $row3) {
                $redacteur = $row3['pseudo'];
            }

            echo "<p>" . $redacteur . " a dit:" . "</br>"
                . $row2['textereponse'] . "</br> 
                                    le " . $row2['daterep']
                . "</p>";
        }
    }

    echo "</article>";
    if (isset($_SESSION['login'])) {
        if ($_SESSION['login'] === 'ok') {
            ?>
            <article>
                <h1>Répondre à cet article</h1>

                <form name='addrep' action='viewArticle.php?Titre=<?php echo $title ?>' method='post'>
                    <textarea id="reponse" name="reponse" rows="30" cols="40" placeholder="Ecrire ici..."></textarea> </br>
                    <input id="submit" name="Submit" type="submit" /> </br>
                </form>
            </article>
    <?php
        }
    }
    ?>
    <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
    <?php

    ?>



</body>

</html>