<?php
require_once 'connexion.php';
require_once 'inscription.php';
if (isset($_POST['mail']) && isset($_POST['conf_mail']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['conf_mdp'])) {
    if (!empty($_POST['mail']) && !empty($_POST['conf_mail']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['conf_mdp'])) {
        session_start();
        
        $mail = trim($_POST['mail']);
        $conf_mail = trim($_POST['conf_mail']);
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $pseudo = trim($_POST['pseudo']);
        $mdp = $_POST['mdp'];
        $conf_mdp = $_POST['conf_mdp'];


        $check = $objPdo->prepare('SELECT pseudo FROM redacteur WHERE pseudo = ?');
        $check->execute(array($pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();

        if ($row == 0) {

            if ($mdp === $conf_mdp && $mail === $conf_mail) {

                $insert = $objPdo->prepare('INSERT INTO redacteur (nom, prenom, adressemail, motdepasse, pseudo) VALUES (?,?,?,?,?);');
                $insert->bindValue(1, $nom, PDO::PARAM_STR);
                $insert->bindValue(2, $prenom, PDO::PARAM_STR);
                $insert->bindValue(3, $mail, PDO::PARAM_STR);
                $insert->bindValue(4, $mdp, PDO::PARAM_STR);
                $insert->bindValue(5, $pseudo, PDO::PARAM_STR);
                $insert->execute();

                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;

                header('Location: gestionSeConnecter.php?FromInscri=true');
            } else {
                header('Location: inscription.php?erreur_inscript=err_conf');
            }
        } else {
            header('Location: inscription.php?erreur_inscript=pseudo_existant');
        }
    } else {
        header('Location: inscription.php?erreur_inscript=champs_vides');
    }
} else {
    header('Location: inscription.php?erreur_inscript=mq_infos');
}
