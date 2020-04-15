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
	/*récupération des tous les id de questions dans la base de données*/

		if(isset($_SESSION['pseudo'])){
			

			/*Selection d'une question au hasard dans la base de données*/
			$requete = $db->query("SELECT * FROM questions ORDER BY rand() LIMIT 1");
    		while ($row = $requete->fetch())   {
      			$_SESSION['reponse'] = $row['reponse'];
				$_SESSION['question'] = $row['question']; 
    		}



			/*affichage de la question*/
			$question=$_SESSION['question'];
			echo "<div class='reponse'>$question<br><br>
					<form action='reponse.php' class='ReponseUser' method='post'>
						Vrai<input type='radio' name='choix' value='V' required>
						Faux<input type='radio' name='choix' value='F' required> <br><br>
						<input type='submit' name='send' value='Valider mon choix'>
					</form>";

		}
		else{
			echo "<br><p class='SeConnecter'>Vous n'êtes pas connecté. Pour pouvoir jouer, veuillez vous connecter en cliquant ici : <a class='SeConnecter' href='connexion.php'> Se connecter </a></p>";
		}
	?>



</body>

</html>
