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
			$_SESSION['pseudo'] = $_REQUEST['pseudo'];
			$_SESSION['email'] = $_REQUEST['email'];
			if ($_REQUEST["sexe"]=="M"){
				$_SESSION['sexe'] ="un homme";
			}
			else{
				$_SESSION['sexe'] ="une femme";
			}
			$_SESSION['connecte']=true;
		?>



		<?php
			$Pseudo_User=$_REQUEST["pseudo"];
			
			echo "L'utilisateur ",$Pseudo_User," est ",$_SESSION['sexe']," et vient de créer un nouveau compte.";
		?>

		
		

		<p>Bienvenue, <?php echo $_SESSION['Pseudo'] ?>, tu es désormais connecté! </p>

	</body>
</html>