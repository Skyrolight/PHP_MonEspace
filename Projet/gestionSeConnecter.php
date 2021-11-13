<?php
    if (isset($_GET['FromInscri'])) {
        if ( ($_GET['FromInscri']) == 'true') {
            session_start();
            $erreur = array();
            $pseudo = $_SESSION['pseudo'];
            $mdp = $_SESSION['mdp'];
            session_destroy();
            seconnecter($erreur, $pseudo, $mdp);
        }
    } else if (isset($_POST['Valider'])) {
        $erreur = array();
        $valeur = array();

        if (!isset($_POST['pseudo']) or strlen(trim($_POST['pseudo'])) == 0) {
            $erreur['nom']='Veuillez saisir votre pseudo';
            $valeur['pseudo'] = 0;
            echo '<script>alert("Veuillez saisir votre pseudo"); </script>';
        } else {
            $valeur['pseudo'] = trim($_POST['pseudo']);
        }
        if (!isset($_POST['mdp']) or strlen(trim($_POST['mdp'])) == 0) {
            $erreur['mdp']='Veuillez saisir votre mot de passe';
            $valeur['mdp'] = 0;
            echo '<script>alert("Veuillez saisir votre mot de passe"); </script>';
        } else {
            $valeur['mdp'] = trim($_POST['mdp']);
        }
        seconnecter($erreur, $valeur['pseudo'], $valeur['mdp']);
    } else{
        echo '<script>alert("erreur de connexion") </script>';
        header('Location: accueil.php');
    }

    function seconnecter($erreur, $pseudo, $mdp) {
        if(count($erreur)==0) {
            require_once("connexion.php");
            session_start();
            $requete = $objPdo->prepare("SELECT count(*) FROM redacteur WHERE pseudo=? AND motdepasse=?;");
            $requete->bindValue(1, $pseudo, PDO::PARAM_STR);
            $requete->bindValue(2, $mdp, PDO::PARAM_STR);
            $requete->execute();
            $reponse = $requete->fetch(PDO::FETCH_ASSOC);
            $val = $reponse['count(*)'];

            if ($val!=0) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['login'] = 'ok';
                if (isset($_GET['FromArticle'])) {
                    if ( ($_GET['FromArticle']) == 'true') {
                        $titre = $_GET['Titre'];
                        header('Location: viewArticle.php?Titre='. $titre);
                    } else 
                        header('Location: accueil.php');
                } else 
                    header('Location: accueil.php');
            } else if (isset($_GET['FromArticle'])) {
                if ( ($_GET['FromArticle']) == 'true') {
                    $titre = $_GET['Titre'];
                    header('Location: seconnecter.php?Titre='.$titre.'&FromArticle=true&erreur=1');
                    } else 
                    header('Location: seconnecter.php?&erreur=1');
            } else
                header('Location: seconnecter.php?erreur=1');  
        } else if (isset($_GET['FromArticle'])) {
            if ( ($_GET['FromArticle']) == 'true') {
                $titre = $_GET['Titre'];
                header('Location: seconnecter.php?Titre='.$titre.'&FromArticle=true&erreur=1');
                } else 
                header('Location: seconnecter.php?&erreur=1');
            }
    $objPdo = NULL;
    }            
?>