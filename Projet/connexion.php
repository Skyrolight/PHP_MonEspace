    <?php
        $db_config = array();
        $db_config['SGBD'] = 'mysql';
        $db_config['HOST'] = 'devbdd.iutmetz.univ-lorraine.fr';
        $db_config['DB_NAME'] = 'welfring7u_ProjetPHP';
        $db_config['USER'] = 'welfring7u_appli';
        $db_config['PASSWORD'] = 'welfringer';

		try {
            $objPdo = new PDO ($db_config['SGBD'] .':host='. $db_config['HOST'].'; dbname='. $db_config['DB_NAME'], $db_config['USER'],$db_config['PASSWORD'], array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")); 
            unset($db_config);    
            $objPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $objPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }
            catch(PDOException $exception ) {
                die($exception->getMessage());
            }
        return $objPdo;
    ?>
