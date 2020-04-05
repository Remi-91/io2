<?php
	define('HOST', 'localhost');
	define('DATABASE_NAME', 'io2');
	define('USER', 'root');
	define('PASS', '');


/*Code pour générer les erreurs lors de la connexion*/
	try{
		$data_base = new PDO('mysql:host=' . HOST . '; data_base=' . DATABASE_NAME, USER, PASS);
		$data_base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "connection ok";
	} catch(PDOException $e){
		echo $e;
	}

?>