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
		Pseudo : <INPUT type="text" name='pseudo' value= <?php if(isset($_SESSION['pseudo'])){echo $_SESSION['pseudo'];}?> > <br><br>
		Email : <INPUT type="text" name='email' value= <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?> > <br><br>
		Sexe : Homme<INPUT type="radio" name='sexe' value='M' required <?php if(isset($_SESSION['sexe']) && $_SESSION['sexe']=="M"){echo "checked";}?> >
		Femme : <INPUT type="radio" name="sexe" value="F" required <?php if(isset($_SESSION['sexe']) && $_SESSION['sexe']=="F"){echo "checked";}?>> <br><br>
		<INPUT type="submit" name='send' id='send' value="Enregistrer les modifications">	


	<?php
		if(isset($_POST['send']) && isset($_SESSION['pseudo'])){
					
			/*Modification des infos perso*/	
			if(!empty($_POST['sexe']) && !empty($_POST['email']) && !empty($_POST['pseudo'])){
				include 'database.php'; 
				global $db;		

				$NouveauEmail = $_POST['email'];
				$NouveauPseudo = $_POST['pseudo'];
				$NouveauSexe = $_POST['sexe'];
					
				/*Modification de l'email*/
				if($NouveauEmail!=$_SESSION['email']){
					/*Verification de l'unicité du nouvel email*/
					$EmailActuel = $_SESSION['email'];
					$p = $db->prepare("SELECT email FROM utilisateurs WHERE email = '$NouveauEmail' ");
					$p -> execute();
					$NombreDemail = $p -> rowCount();

					if($NombreDemail!=0){
						echo " <br> Vous ne pouvez pas choisir cet email: un compte est déjà associé à celui-ci. <br>";
					}
					else{
						$EmailActuel = $_SESSION['email'];
						$PseudoActuel = $_SESSION['pseudo'];
						$q= $db -> prepare("UPDATE utilisateurs SET email = '$NouveauEmail' WHERE pseudo = '$PseudoActuel' ");
						$q -> execute();
						$_SESSION['email']=$NouveauEmail;
					}	
				}

				/*Modification du pseudo*/
				if($NouveauPseudo!=$_SESSION['pseudo']){
					/*Verification de l'unicité du nouveau pseudo*/
					$PseudoActuel = $_SESSION['pseudo'];
					$n = $db->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = '$NouveauPseudo' ");
					$n -> execute();
					$NombrePseudo = $n -> rowCount();

					if($NombrePseudo!=0){
						echo " <br>Ce pseudo est déjà utilisé par un autre utilisateur du site. <br>";
					}
					else{
						$PseudoActuel = $_SESSION['pseudo'];
						$q= $db -> prepare("UPDATE utilisateurs SET pseudo = '$NouveauPseudo' WHERE pseudo = '$PseudoActuel' ");
						$q -> execute();
						$_SESSION['pseudo']=$NouveauPseudo;
					}	
				}
				
				/*Modification du sexe*/
				if($NouveauSexe!=$_SESSION['sexe']){
					$SexeActuel = $_SESSION['sexe'];
					$PseudoActuel = $_SESSION['pseudo'];
					$q= $db -> prepare("UPDATE utilisateurs SET sexe = '$NouveauSexe' WHERE pseudo = '$PseudoActuel' ");
					$q -> execute();
					$_SESSION['sexe']=$NouveauSexe;
				}
			
				
				
				

				echo "<br>L'utilisateur ",$_SESSION['pseudo']," de sexe ",$_SESSION['sexe']," vient de modifier ses informations personnelles compte.<br>"; 
							
			}

			else{
				echo "Tous les champs n'ont pas été remplis!";
			}				
		}

		if(isset($_POST['send2']) && !isset($_SESSION['pseudo'])){
			echo "Vous ne pouvez pas modifier vos informations tant que vous n'êtes pas connectés.";
		}

	?>



	<form class="infoPerso" method="post">
		<INPUT type="submit" name='send2' id='send2' value="Supprimer mon compte">

	<?php
	/*Si l'utilisateur est connecté, il peut supprimer son compte s'il le souhaite*/
		if(isset($_POST['send2']) && isset($_SESSION['pseudo'])){
			
			include 'database.php'; 
			global $db;	
			

			$tmp=$_SESSION['pseudo'];
			$q = $db->prepare("DELETE FROM utilisateurs WHERE pseudo = '$tmp' ");
			$q->execute(); 

			echo "Votre compte a été supprimé";

			$_SESSION['pseudo']= NULL;
			$_SESSION['email']= NULL;
			$_SESSION['sexe']= NULL;
		
		}
	?>


	<?php
	/*Si l'utilisateur n'est pas connecté, il ne peut pas voir les informations qui le concernent : il doit se connecter*/
	if(!isset($_SESSION['pseudo']) || !isset($_SESSION['email']) || !isset($_SESSION['sexe'])){
		echo "<br><p>Vous n'êtes pas connecté. Pour consulter ou modifier vos informations personnelles, veuillez vous connecter en cliquant ici : <a class='SeConnecter' href='connexion.php'> Se connecter </a></p>";
	}
	?>



</body>

</html>
