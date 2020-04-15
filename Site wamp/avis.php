<?php
	session_start();
	include 'database.php'; 
	global $db;
?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/contact.css">
	<title>Contact</title>
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
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
		</div>
	</header>

	<h1>Vos avis</h1>
	<?php
	if(isset($_SESSION['pseudo'])){
		/*si l'utilisateur est connecté, il peut poster un commentaire à l'aide du code suivant*/
		$tmp = $_SESSION['pseudo']; 
		echo "<div class='MonCommentaire'>
			<p>$tmp</p>
			<form method='post'>
				<input type='text' name='Message' size='100' placeholder='Votre commentaire' required> 
				<input type='submit' name='send' id='send' value='Poster le commentaire'>
			</form>
		</div>";

		if(isset($_POST['send'])){
			$q = $db->prepare("INSERT INTO avis(utilisateurs,message) VALUES(:utilisateurs,:message)");
			$q->execute([
				'utilisateurs' => $_SESSION['pseudo'],
				'message' => $_POST['Message']
			]);
		}
	}

	?>

	<?php
	/*affichage de tous les commentaires de la base de données*/

		$q = $db->query("SELECT * FROM avis");
		while($avis = $q->fetch()){
			$message=$avis['message'];
			$user=$avis['utilisateurs'];
			echo "<div class='commentaire'><p class='utilisateur'>$user</p><p class='message'>$message</p></div>";
		}
	?>


</body>

</html>
