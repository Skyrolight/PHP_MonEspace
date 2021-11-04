
<?php
    session_start();
    if(isset($_SESSION['login'])) {
        $pseudo = $_SESSION['pseudo'];
    }
 ?> 
 
 <html>
     <head>
         <meta charset="utf-8">
         <title> Créer un article</title>
         <link rel="stylesheet" href="projet.css">
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
             }
             else { 
                $titre = trim($_POST['titre']); 
             }
 
             if (!isset($_POST['descriptif']) or strlen(trim($_POST['descriptif']))==0){  //Verification texte non vide
                 $erreur['descriptif'] = 'saisie obligatoire du texte de l\'article'; 
             }
             else { 
                 $_POST['descriptif'] = trim($_POST['descriptif']); 
             }
 
             if (count($erreur)==0){ //Il n'y a pas d'erreur : on peut insérer dans la BDD
                
 
                 $req = 'INSERT INTO sujet (idsujet, idredacteur, titresujet, textesujet, datesujet) VALUES(:idsujet,:idredac,:titre,:texte,:datesuj)';
                 $insert = $objPdo->prepare($req);
                
                 $insert->execute(array('idsujet'=>0,
                                     'idredac'=>$idredac,
                                     'titre'=>$titre,
                                     'texte'=>$_POST['descriptif'], 
                                     'datesuj'=>$date));
                 header("location.href='viewArticle.php?Titre=<?php echo $titre ?>';");
             }
         }
     ?>
 
     <body class="body">
            <?php
                
                if(isset($_GET['deconnexion'])) { 
                   if($_GET['deconnexion']=='true') {  
                      $_SESSION[] = array();
                      session_destroy();
                      header("Location: accueil.php?deconnected=true");
                   }
                } else if(isset($_SESSION['login'])) {
                        if (($_SESSION['login']) === 'ok') {
                            
                            // afficher un message
                            echo '<a href="accueil.php?deconnexion=true"><span>Déconnexion</span></a>';
                            echo "<br>Bonjour $pseudo, vous êtes connectés";
                            
                        }
                    } else echo '<a href="seconnecter.php">se connecter</a>';
            ?>

         <article class="div">
             <h1> Création d'un nouvel article </h1>
         </article>
 
         <article class="div">
             <form name='add' action='createArticle.php' method='post'>
 
                 <label for="titre">Titre </label> </br>
                 <input id="titre" name="titre" type="text" autofocus="true" placeholder="Insérer un titre" /> </br>
 
                 <label for="descriptif">Descriptif </label> </br>
                 <textarea id="descriptif" name="descriptif" rows="30" cols="40" placeholder="Ecrire ici..."> </textarea> </br>
 
                 <input id="submit" name="submit" type="submit"  /> </br>
                 <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
             </form>
         </article>
     </body>
 </html>