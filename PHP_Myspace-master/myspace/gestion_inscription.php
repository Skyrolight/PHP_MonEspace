<?php
require_once 'connexion_bdd.php';
require_once 'inscription.php';
if (isset($_POST['mail']) && isset($_POST['conf_mail']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['conf_mdp'])) {
    if (!empty($_POST['mail']) && !empty($_POST['conf_mail']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['conf_mdp'])) {
        $idredacteur = 'RED' . '4';
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

                $insert = $objPdo->prepare('INSERT INTO redacteur(idredacteur,nom,prenom,adressemail,motdepasse,pseudo) VALUES(:idredacteur,:nom,:prenom,:adressemail,:motdepasse,:pseudo)');
                $insert->execute(array(
                    'idredacteur' => $idredacteur,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'adressemail' => $mail,
                    'pseudo' => $pseudo,
                    'motdepasse' => $mdp,
                ));

                header('Location:accueil.php?erreur_inscript=succes' . $pseudo);
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
