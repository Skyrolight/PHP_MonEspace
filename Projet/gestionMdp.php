<?php

require_once 'connexion.php';

if (!isset($_POST['adresse']) or strlen(trim($_POST['adresse'])) == 0) {
    echo '<script>alert("Veuillez saisir votre pseudo"); </script>';
    header('Location: mdpMail.php');

} else {

    $select = 'SELECT * from redacteur where adressemail = :titrechoisi';
    $result  = $objPdo->prepare($select);
    $result->execute(array('titrechoisi' => $_POST['adresse']));
    
    foreach ($result as $row) {
        $message = "Votre mot de passe : ".$row['motdepasse'];
        $message = wordwrap($message, 70, "\r\n");
        mail($_POST['adresse'], 'Mot de passe', $message);
    }
    header('Location: seconnecter.php');
}

?>