<?php
session_start();
require_once 'connexion.php';
require_once 'connexion_bdd.php';
if (isset($_POST['user']) && isset($_POST['mdp'])) {

    $pseudo = $_POST['user'];
    $password = $_POST['mdp'];

    $check = $objPdo->prepare('SELECT pseudo, motdepasse FROM redacteur WHERE pseudo = ?');
    $check->execute(array($pseudo));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row > 0) {

        if ($password == $data['motdepasse']) {

            $_SESSION['login'] = 'ok';
            header('Location: accueil.php?erreur_connect=' . $pseudo);
        } else {
            header('Location: connexion.php?erreur_connect=fail_mdp');
        }
    } else {
        header('Location: connexion.php?erreur_connect=pseudo_inexistant');
    }
}
