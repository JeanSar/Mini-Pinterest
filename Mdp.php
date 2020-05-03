<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Quelle photo ?</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
		<link rel="stylesheet" href="style.css">

		<div class='w3-container w3-teal w3-center'>
			<h1>Mini Pinterest le site !</h1>
			<?php
				require_once('./fonctions/Image.php');
				require_once('./fonctions/Connexion.php');
				require_once('./fonctions/Affichage.php');
				session_start();
			if(isset($_SESSION['logged'])){
				$link=getConnection();
				formulaireConnexion();
				formulaireCreerCompte();
				echo '<br>';
				afficherStat();
			}
			else{
				header('Location: Accueil.php');
			}
		?>
		<br>
		<a href="Accueil.php" class="bouton-relief">Revenir à l'accueil</a>
		</div>
		
	</head>
</html>