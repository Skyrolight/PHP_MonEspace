<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
	</head>
	<body>
    <?php
		try {
            $objPdo = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=welfring7u_ProjetPHP' , 'welfring7u_appli', 'welfringer', array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8") ); 
            $objPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo '<script> console.log("connexion établie") </script>';
            }
            catch(PDOException $exception ) {
                die($exception->getMessage());
            }
    ?>
</body>
</html>