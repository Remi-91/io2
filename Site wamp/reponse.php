<?php
	session_start();
	include 'database.php'; 
	global $db;	
?>

<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/jouer.css">
	<title>Jouer</title>
</head>

<body>
	<header>
		<div class="header">
			<a class="NomDuSite "href="accueil.php">Card<span>Game</span></a>
			<img src="img/question.jpg" width=100% height="400">
			<div class="nav">
				<ul>
					<li><a href="accueil.php">Accueil</a></li>
					<li><a href="#">Jouer</a></li>
					<li><a href="informations.php">Informations</a></li>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="avis.php">Vos avis</a></li>
				</ul>
			</div>
		</div>
	
	</header>

	<a class="creation" href="creation.php"> Créer des cartes </a>

	<?php
		if(isset($_SESSION['pseudo'])){
			

			/*affichage de la question*/
			$question=$_SESSION['question'];
			echo"<div class='reponse'>$question<br>"
					/*<form action='reponse.php' class='ReponseUser' method='post'>
						Vrai<input type='radio' name='choix' value='V' required>
						Faux<input type='radio' name='choix' value='F' required> <br>
					</form>"*/;


			
			if($_POST['choix'] == $_SESSION['reponse']){
				echo "<p class='correct'>bonne réponse</p>";
			}
			else{
				echo "<p class='incorrect'>mauvaise réponse</p>";
			}

			echo "<p class='suivant'><a href='jouer.php'> Suivant </a></p></div>";

		}
	?>

		


</body>

</html>
