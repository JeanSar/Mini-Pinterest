<!DOCTYPE html>
	<?php
		require_once('./fonctions/Image.php');
		require_once('./fonctions/Connexion.php');
		require_once('./fonctions/Affichage.php');
		session_start();
	?>
<html>
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
				formulaireConnexion();
				formulaireCreerCompte();
		?>
		</div>
	</head>
	<body>

	<p>
		<form class="w3-container w3-center" action="Accueil.php" method="post">

			<label for="categorie">Choisissez une catégorie </label>
			<select name="Categorie" id="categorie">
				<option value="TOUT">Tout</option>
				<option value="Fruit">Fruits</option>
				<option value="Legume">Legumes</option>
			</select>
			<input  class="w3_button w3-teal" type="submit" name="afficher" value="Afficher"/>
		</form>
			<br />
		<form class="w3-container w3-center" action="Accueil.php" method="post">
			<label for="recherche">Rechercher une image : </label>
			<input type ="search" name="recherche" id="recherche" placeholder="Rechercher ..."/>
			<input  class="w3_button w3-teal" type="submit" name="rechercher" value = "Go!"/ >
		</form>
		<br />
		<?php
		Categorie();
		Recherche();
		?>
	</body>
</html>
