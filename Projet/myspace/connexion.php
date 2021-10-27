<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
	</head>
	<body>
    <?php
		try {
            $objPdo = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=welfring7u_tpPHP' , 'welfring7u_appli', 'welfringer', array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8") ); 
            }
            catch( Exception $exception ) {
                die($exception->getMessage());
            }
    ?>
</body>
</html>