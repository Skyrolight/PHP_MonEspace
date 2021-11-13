
<?php
    session_start();
    if(isset($_SESSION['login'])) {
        $pseudo = $_SESSION['pseudo'];
    }
 ?> 
 
 <html>
     <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Créer un article - MonEspace</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="accueil.css">
     </head> 
 
     <?php
         require_once('connexion.php');
         
         if (isset($_POST['submit'])){
             $erreur=array();
             $valeur=array();
             $date = date('Y/m/d', time());
             $reqidredac = $objPdo->prepare('SELECT idredacteur FROM redacteur WHERE pseudo = :loginredac');
             $reqidredac->bindValue('loginredac', $pseudo, PDO::PARAM_STR);
             $reqidredac->execute();
             foreach($reqidredac as $row){
                 $idredac = $row['idredacteur']; 
             }

             //$idredac->execute(array(':loginredac'=>$_SESSION['user']));
 
             $redac = intval($idredac);
 
             if (!isset($_POST['titre']) or strlen(trim($_POST['titre']))==0){  //Verification titre non vide
                 $erreur['titre'] = 'saisie obligatoire du titre'; 
                 $valeur['titre'] = 0;
             }
             else { 
                $valeur['titre'] = trim($_POST['titre']); 
             }
             
             if (!isset($_POST['descriptif']) or strlen(trim($_POST['descriptif']))==0){  //Verification texte non vide
                 $erreur['descriptif'] = 'saisie obligatoire du texte de l\'article'; 
                 $valeur['descriptif'] = 0;
             }
             else { 
                $valeur['descriptif'] = trim($_POST['descriptif']); 
             }
 
             if (count($erreur)==0){ //Il n'y a pas d'erreur : on peut insérer dans la BDD
                
                $check = $objPdo->prepare('SELECT titresujet FROM sujet WHERE titresujet = ?');
                $check->execute(array($valeur['titre']));
                $data = $check->fetch();
                $row = $check->rowCount();
                if ($row == 0) {
                    $req = 'INSERT INTO sujet (idsujet, idredacteur, titresujet, textesujet, datesujet) VALUES(:idsujet,:idredac,:titre,:texte,:datesuj)';
                    $insert = $objPdo->prepare($req);
                
                    $insert->execute(array('idsujet'=>0,
                                    'idredac'=>$idredac,
                                    'titre'=>$valeur['titre'],
                                    'texte'=>$valeur['descriptif'], 
                                    'datesuj'=>$date));
                    $titre = $valeur['titre'];
                    var_dump($titre);
                    echo '<script>alert("Veuillez saisir votre pseudo"); </script>';
                    header('location: viewArticle.php?Titre='.$titre.'&FromCreateArticle=true');
                } else {
                    header('location: createArticle.php?erreur=err_titre');
                }
             } else {
                header('location: createArticle.php?erreur=err_titre');
             }
         }
     ?>
 
    <body style="min-width: 1250px">
        <nav class="navbar" style="position: sticky;top: 0;">
                <div id="titreSite">
                    <a href="accueil.php" style="text-decoration: none;">MonEspace</a>
                </div>
                <div id="connecter">
                    <?php
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
                                    <?php
                                }
                            } else echo '<a href="seconnecter.php" class="createArticleLien">se connecter</a>';
                    ?>
                </div>
            </nav>
        <div class="contentCreate">
            <article class="div">
                <h1 style="margin:0;"> Création d'un nouvel article </h1>
            </article>
    
            <article class="div">
                <form class="formCreateArticle" name='add' action='createArticle.php' method='post'>
    
                    <label for="titre" class="titreCreateArticle">Titre </label> </br>

                    <?php if (isset($_GET['erreur'])) {
                        
                        echo '<input class="titreInputCreateArticle" name="titre" type="text" autofocus="true" placeholder="Insérer un titre" value=">'; 
                    } else {
                        echo '<input class="titreInputCreateArticle" name="titre" type="text" autofocus="true" placeholder="Insérer un titre" /> </br>';
                    } ?>
                    <label for="descriptif">Descriptif </label> </br>
                    <textarea class="descriptif" name="descriptif" rows="30" cols="40" placeholder="Ecrire ici..."></textarea> </br>

                    <input id="btnInscArticle" name="submit" type="submit"  style="width: 20%;"/> </br>
                    <input type="button" value="Retour" id="btnRetourArticle" onclick="location.href='accueil.php'" style="width: 20%;">
                </form>

                <?php
                    if (isset($_GET['erreur'])) {
                            echo "<p style='color:red'>Le titre est invalide ou déjà créé !</p>";
                    }
                    ?>
            </article>
        </div>
     </body>
 </html>