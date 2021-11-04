
<?php
    session_start();
    if(isset($_SESSION['login'])) {
        $pseudo = $_SESSION['pseudo'];
    }
    
 ?> 

<html>
    <head>
        <meta charset="utf-8">
        <title> a modifier</title>
        <link rel="stylesheet" href="projet.css">
    </head>
    
    <body>
            <?php
                require_once('connexion.php');
                
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
        <?php 
            require_once('connexion.php');

            

            $erreur=array();
            $date = date('Y/m/d', time());

            $reqredac = 'SELECT idredacteur from redacteur where pseudo = :psd';
            $selectredac = $objPdo->prepare($reqredac);
            $selectredac->execute(array('psd'=>$pseudo));
            foreach($selectredac as $row3){
                $redacrep = $row3['idredacteur']; 
            }

            
            $select ='SELECT * from sujet where titresujet = :titrechoisi';
            $result  = $objPdo->prepare($select);
            $result->execute(array('titrechoisi'=>$_GET['Titre'])); 
            $_SESSION['title'] = $_GET['Titre'];

            echo "<article>";

            foreach ($result as $row){
                $title = $_SESSION['title'];
                $select2 ='SELECT pseudo from redacteur, sujet where redacteur.idredacteur=sujet.idredacteur and sujet.titresujet = :redac';
                $result2  = $objPdo->prepare($select2);
                $result2->execute(array('redac'=>$title));

                foreach($result2 as $row2){
                    $nomredac = $row2['pseudo']; 

                    echo 
                "<h1>".$row['titresujet']. "</h1>"."</br>"
                .$row['textesujet']."</br>"
                ."ecrit par : ".$nomredac."</br>"
                ."le ".$row['datesujet']."</br>";
                }

                echo "<article>";
                $req = $objPdo->prepare('SELECT idsujet FROM sujet WHERE titresujet=?;'); 
                $req->bindValue(1, $title);
                $req->execute();
                $val = $req->fetchColumn();

                $getidredacteur = $objPdo->prepare('SELECT reponse.idredacteur FROM reponse, sujet WHERE sujet.idsujet=? = reponse.idsujet=?;');
                $getidredacteur->bindValue(1, $val);
                $getidredacteur->bindValue(2, $val);
                $getidredacteur->execute();

                foreach($getidredacteur as $row){

                    $getpseudo = $objPdo->prepare('SELECT pseudo FROM redacteur WHERE idredacteur=?;');
                    $getpseudo->bindValue(1, $row['idredacteur']);
                    $getpseudo->execute();
                    $valpseudo = $getpseudo->fetchColumn(); 
                    
                    $select4 ='SELECT * from reponse, sujet where sujet.idsujet=? = reponse.idsujet=? ';
                    $result4  = $objPdo->prepare($select4);
                    $result4->bindValue(1, $val);
                    $result4->bindValue(2, $val);
                    $result4->execute();

                    foreach ($result4 as $row4 ) {
                        echo "<p>".$valpseudo. " a dit:". "</br>"
                            .$row4['textereponse']. "</br> 
                            le " .$row4['daterep']
                         ."</p>";
                    }
                }

                echo "</article>";

                if (!isset($_POST['reponse']) or strlen(trim($_POST['reponse']))==0){
                    $erreur['reponse'] = 'saisie obligatoire du texte de la réponse';
                }
                if (count($erreur)==0){ //Il n'y a pas d'erreur : on peut insérer dans la BDD
                    
    
                    $req2 = 'INSERT INTO reponse (idreponse, idsujet, idredacteur, daterep, textereponse) VALUES(:idrep,:idsuj,:idredac,:daterep,:texte)';
                    $insert2 = $objPdo->prepare($req2);
                   
                    $insert2->execute(array('idrep'=>0,
                                        'idsuj'=>$row['idsujet'],
                                        'idredac'=>$redacrep,
                                        'daterep'=>$date, 
                                        'texte'=>$_POST['reponse']));
                    header("location.href='viewArticle.php?Titre=<?php echo $title ?>';");
                }
                
            }

            echo "</article>";

            if ($_SESSION['login'] === 'ok'){
                ?>
                <article>
                        <h1>Répondre à cet article</h1>

                        <form name='addrep' action='viewArticle.php?Titre=<?php echo $title ?>' method='post'>
                            <textarea id="reponse" name="reponse" rows="30" cols="40" placeholder="Ecrire ici..."> </textarea> </br>
                            <input id="submit" name="submit" type="submit"  /> </br>
                            <input type="button" value="Retour" class="btn" onclick="location.href='accueil.php'">
                        </form>
                </article>
                <?php
            }

            
        ?>

        
        
    </body>
</html>