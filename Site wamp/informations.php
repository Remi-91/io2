<?php
	session_start();
?>



<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/informations.css">
	<title>Informations</title>
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
					<li><a href="#">Informations</a></li>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
		</div>

	</header>

	<form class="infoPerso" method="post">
		Pseudo : <INPUT type="text" name='pseudo' placeholder= <?php if(isset($_SESSION['pseudo'])){echo $_SESSION['pseudo'];}?> > <br><br>
		Email : <INPUT type="text" name='email' placeholder= <?php if(isset($_SESSION['connecte'])){echo $_SESSION['email'];}?> > <br><br>
		Sexe : Homme<INPUT type="radio" name='sexe' value='M' required>
		Femme : <INPUT type="radio" name="sexe" value="F" required> <br><br>
		<INPUT type="submit" name='send' id='send' value="Enregistrer les modifications">

	<?php
		if(isset($_POST['send'])){
			if(isset($_POST['send'])){
				$_SESSION['pseudo'] = $_REQUEST['pseudo'];
				$_SESSION['email'] = $_REQUEST['email'];
				$_SESSION['sexe'] = $_REQUEST['sexe'];
				$_SESSION['connecte'] = true;
						
				if(!empty($_POST['sexe']) && !empty($_POST['email']) && !empty($_POST['pseudo'])){
					include 'database.php'; 
					global $db;		

							
					/*Verification de l'unicité de l'email*/
					$p = $db->prepare("SELECT email FROM utilisateurs WHERE email = :email");
					$p -> execute(['email' => $_POST['email']]);
					$NombreDemail = $p -> rowCount();

					/*Verification de l'unicité du mot de passe*/
					$n = $db->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = :pseudo");
					$n -> execute(['pseudo' => $_POST['pseudo']]);
					$NombrePseudo = $n -> rowCount();

					if($NombreDemail!=0){
						echo " <br> Un compte est déjà associé à cet email. <br>";
						if($NombrePseudo!=0){
							echo "Ce pseudo est déjà utilisé. <br>";
						}
					}
						else{
							if($NombrePseudo!=0){
								echo "Ce pseudo est déjà utilisé. <br>";
						}
					else{
						$q = $db->prepare("INSERT INTO utilisateurs(pseudo,email,sexe,) VALUES(:pseudo,:email,:sexe)");						
						$q->execute([
						'pseudo' => $_SESSION['pseudo'],
						'email' => $_SESSION['email'],
						'sexe' => $_SESSION['sexe'],
						]); 


						echo "<br>L'utilisateur ",$_SESSION['pseudo']," de sexe ",$_SESSION['sexe']," vient de modifier ses informations personnelles compte.<br>"; 
						echo "Bienvenue, ", $_SESSION['pseudo'], ", tu es désormais connecté!";
									
					}
				}
			}

			else{
				echo "Tous les champs n'ont pas été remplis!";
			}				
		}
		if($_SESSION['connecte']==false){
			echo "<a href=\"connexion.php\">Vous n'êtes pas connecté. Pour consulter ou modifier vos informations personnelles, veuillez vous connecter en cliquant ici. </a>";
		}
	} 
	?>



</body>

</html>