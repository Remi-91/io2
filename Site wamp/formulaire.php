<?php
	session_start();

?>


<html>
	<head>
		<meta charset="utf-8">
		<title>test</title>
	</head>
	<body>
		<?php
			$Nom_User=$_REQUEST["prenom"];
			$Prenom_User=$_REQUEST["nom"];
			
			echo "L'utilisateur ",$Nom_User," ",$Prenom_User," est ",$_SESSION['sexe']," et vient de créer un nouveau compte.";
		?>

		<?php
			$_SESSION['prenom'] = $_REQUEST["prenom"];;
			$_SESSION['nom'] = $_REQUEST["nom"];
			if ($_REQUEST["sexe"]=="M"){
							$_SESSION['sexe'] ="un homme";
						}
						else{
							$_SESSION['sexe'] ="une femme";
						}
			$_SESSION['connecte']=true;
		?>
		

		<p>Bienvenue, <?php echo $_SESSION['prenom'] ?>, tu es désormais connecté! </p>

	</body>
</html>