<?php
	session_start();

?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/connexion.css">
	<title>Connexion</title>
</head>

<body>
	<header>
		<div class="header">
			<a class="NomDuSite "href="accueil.php">Card<span>Games</span></a>
			<img src="img/question.jpg" width=100% height="400">
			<div class="nav">
				<ul>
					<li><a href="accueil.php">Accueil</a></li>
					<li><a href="jouer.php">Jouer</a></li>
					<li><a href="informations.php">Informations</a></li>
					<li><a href="#">Connexion</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
		</div>
	

	</header>


	

	<div class="TousLesFormulaires">
		<ul>
			<li>
				<div class="inscription">
					<p>Création d'un compte</p>
					<form action="formulaire.php" method="post"> 
						Pseudo : <input type="text" name="pseudo" size="30" required=""> <br><br>
						Sexe: Homme : <INPUT type="radio" name="sexe" value="M" required> 
						Femme : <INPUT type="radio" name="sexe" value="F" required> <br><br>
						email : <INPUT type="email" name="email" required> <br><br>
						Mot de passe : <input type="password" name="passwd" size="16" required> <br><br>
						Valider : <input type="submit">
					</form>
				</div>
			</li>
		
		
			<li>
				<div class="connexion">
					<p>Connexion</p>
					<form action="formulaire.php" method="post">
						Pseudo : <input typr="text" name="pseudo" size="30" required> <br><br>
						Identifiant : <input type="password" name="p" size="16" required> <br><br>
					</form>
				</div>
			</li>
		</ul>
		
	</div>

	<?php 
		include 'database.php'; 
		global $data_base;
	?>




</body>

</html>