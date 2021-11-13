<!DOCTYPE html>
<html>
    <head>
        <title>RECHERCHER</title>
    </head>
    <body>
        <div id="container">
            <h1>Rechercher</h1>
        </div>
    </body>
</html>

<?php

if (isset($_POST['barRecherche'])) {
    if (!empty($_POST['barRecherche'])){
        $recherche = trim($_POST['barRecherche']);
        echo "ca va";
        header('Location: accueil.php?search='.$recherche);
    }
    else{
        header('Location:  accueil.php');
    }

}
else{
    header('Location:  accueil.php');
}
