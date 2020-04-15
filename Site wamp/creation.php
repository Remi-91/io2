<?php
	session_start();
?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/creation.css">
	<title>Creation</title>
</head>

<body>
	<header>
		<div class="header">
			<a class="NomDuSite "href="accueil.php">Card<span>Game</span></a>
			<img src="img/question.jpg" width=100% height="400">
			<div class="nav">
				<ul>
					<li><a href="accueil.php">Accueil</a></li>
					<li><a href="jouer.php">Jouer</a></li>
					<li><a href="informations.php">Informations</a></li>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="avis.php">Vos avis</a></li>
				</ul>
			</div>
		</div>
	
	</header>


	<?php
	if(isset($_SESSION['pseudo'])){
		echo"<div class='crea'>
				<p class='creez'>Créez votre propre question ici</p><br>
				<form method='post'>
					Votre question : <input type='text' name='question' size='100'placeholder='Quel est...' required><br><br>
					La réponse à votre est question est : Vrai<input type='radio' name='reponse' value='V' required> Faux <input type='radio' name='reponse' value='F' required><br><br>
					Valider : <input type='submit' name='send' id='send' value='go !'><br><br>
				</form>
			</div>";

		if(isset($_POST['send'])){
			include 'database.php'; 
			global $db;	

			$q = $db->prepare("INSERT INTO questions (question,reponse) VALUES(:question,:reponse)");
			$q->execute([
				'question' => $_POST['question'],
				'reponse' => $_POST['reponse']
			]); 
		}
	}
	else{
		/*Si l'utilisateur n'est pas connecté, il ne peut pas voir les informations qui le concernent : il doit se connecter*/
		if(!isset($_SESSION['pseudo']) || !isset($_SESSION['email']) || !isset($_SESSION['sexe'])){
			echo "<br><p>Vous n'êtes pas connecté. Pour pouvoir créer vos propres cartes, veuillez vous connecter en cliquant ici : <a class='SeConnecter' href='connexion.php'> Se connecter </a></p>";
		}
	}

	?>




	<footer>
		<p>CardGame</p>
	</footer>

</body>

</html>
