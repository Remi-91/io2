<?php
	define('HOST', 'localhost');
	define('DB_NAME', 'io2');
	define('USER', 'root');
	define('PASS', '');


	
/*Code pour générer les erreurs lors de la connexion*/

	try{
		$db = new PDO('mysql:host=' . HOST . '; dbname=' . DB_NAME, USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
		echo $e;
	}

?>