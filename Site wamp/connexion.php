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
						<form method="post"> 
							Pseudo : <INPUT type="text" name="pseudo" size="30" placeholder="Choisi ton pseudo!" required=""> <br><br>
							Sexe: Homme <INPUT type="radio" name="sexe" value="M" required>
							Femme <INPUT type="radio" name="sexe" value="F" required> <br><br>
							email : <INPUT type="email" name="email" placeholder="et ton email!" required> <br><br>
							Mot de passe : <input type="password" name="password" size="16" required> <br><br>
							Valider : <input type="submit" name="send" id="send" value="c'est parti !">
						</form>
					</div>
				</li>
			
			
				<li>
					<div class="connexion">
						<p>Connexion</p>
						<form method="post">
							Pseudo : <input type="text" name="pseudoConnexion" size="30" placeholder="saisi ton pseudo!" required> <br><br>
							Mot de passe : <input type="password" name="passwordConnexion" size="16" required> <br><br>
							Valider : <input type="submit" name="sendConnexion" id="send2" value="go !">
						</form>
					</div>
				</li>
			</ul>
			
		</div>

		

		<?php
		/*PHP pour le formulaire d'inscription*/

			if(isset($_POST['send'])){

				if(!empty($_POST['password']) && !empty($_POST['sexe']) && !empty($_POST['email']) && !empty($_POST['pseudo'])){
					
					include 'database.php'; 
					global $db;		

					
					$options = ['cost' => 12,];
					$passwordCRYPT = password_hash($_REQUEST['password'], PASSWORD_BCRYPT, $options);


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

							$_SESSION['pseudo'] = $_REQUEST['pseudo'];
							$_SESSION['email'] = $_REQUEST['email'];
							$_SESSION['sexe'] = $_REQUEST['sexe'];


							$q = $db->prepare("INSERT INTO utilisateurs(pseudo,email,sexe,password) VALUES(:pseudo,:email,:sexe,:password)");
							$q->execute([
								'pseudo' => $_SESSION['pseudo'],
								'email' => $_SESSION['email'],
								'sexe' => $_SESSION['sexe'],
								'password' => $passwordCRYPT
							]); 

							
							echo "<br>L'utilisateur ",$_SESSION['pseudo']," est de sexe ",$_SESSION['sexe']," vient de créer un nouveau compte.<br>"; 
							echo "Bienvenue ", $_SESSION['pseudo'], ", tu es désormais connecté!";
							
						}
					}
				}

				else{
					echo "Tous les champs n'ont pas été remplis!";
				}				
			}
		?>



		<?php
			/*php pour le formulaire de connexion*/
			
			if(isset($_POST['sendConnexion'])){

				include 'database.php'; 
				global $db;


				/*On vérifie si tous les champs du formulaire sont bien remplis*/
				if(!empty($_POST['pseudoConnexion'] && !empty($_POST['passwordConnexion']))){

					$r = $db->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");
					$r->execute(['pseudo' => $_POST['pseudoConnexion']]);
					$result = $r->fetch();


					/*On vérifie que le compte associé au pseudo existe bien*/
					if($result==true){
						
						/*On vérifie que le mot de passe est correct*/
						if(password_verify($_POST['passwordConnexion'], $result['password'])){
							
							$_SESSION['pseudo'] = $result['pseudo'];
							$_SESSION['email'] = $result['email'];
							$_SESSION['sexe'] = $result['sexe'];

							echo "Bienvenue, ", $_SESSION['pseudo'], ", tu es désormais connecté!";

						}


						else{
							echo "mot de passe incorrect"."\n";
						}
					}

					/*Dans le cas ou le compte n'exoste pas : */
					else{
						echo "Le pseudo saisit n'est pas correct"."\n";
					}

				}
				/*Dans le cas où tous les champs ne sont pas rmeplis : */
				else{
					echo "Tous les champs ne sont pas remplis!"."\n";
				}
			}

		?>


	</body>
</html>
