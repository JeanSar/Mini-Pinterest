<!DOCTYPE html>
<html>

<?php
	require_once('./fonctions/Image.php');
	require_once('./fonctions/Connexion.php');
	require_once('./fonctions/Affichage.php');

?>
	<title>Mini Pinterest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="style.css">
	<head>
		<div class='w3-container w3-teal w3-center'>
			<h1>Mini Pinterest le site !</h1>
			<?php

			session_start();
			if(isset($_SESSION['logged'])){
				formulaireConnexion();
				formulaireCreerCompte();
				echo '<br>';


			}

			?>
			<br />
			<a href="Accueil.php" >Retourner à l'accueil</a>
		</div>
			<?php $link=getConnection();
			echo "<h2>Toutes les photos</h2>";
			afficherTout($link);
			?>
</html>
