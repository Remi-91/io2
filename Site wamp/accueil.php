<?php
	session_start();

?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/accueil.css">
	<title>Accueil</title>
</head>

<body>
	<header>
		<div class="header">
			<a class="NomDuSite" href="#">Card<span>Games</span></a>
			<img src="img/question.jpg" width=100% height="400">
			<div class="nav">
				<ul>
					<li><a href="#">Accueil</a></li>
					<li><a href="jouer.php">Jouer</a></li>
					<li><a href="informations.php">Informations</a></li>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
		</div>
	

	</header>


	<div class="contenu">
		<p>test de contenu</p>
		<p>Un second test</p>
	</div>




	<footer>
		<?php
		echo "L'utilisateur ",$_SESSION['pseudo']," ",$_SESSION['email']," de sexe ",$_SESSION['sexe']," vient de créer un nouveau compte.";
		?>
		<p>CardGame</p>
	</footer>
</body>

</html>