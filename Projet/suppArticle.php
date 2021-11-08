<?php
    require_once('connexion.php');
    $id = $_GET['id'];
    $requete = $objPdo->prepare('DELETE FROM sujet WHERE sujet.idsujet = ?;');
    $requete->bindValue(1, $_GET['id'], PDO::PARAM_INT);
    $requete->execute();
    header("location: accueil.php");
?>  