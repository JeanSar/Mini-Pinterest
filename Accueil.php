<!DOCTYPE html>
	<?php
		require_once('./fonctions/Image.php');
		require_once('./fonctions/Connexion.php');
	?>
<html>
	<title>Mini Pinterest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="Acceuil.css">
	<head>
	</head>

	<body>
	<div class="w3-container w3-center w3-teal">
		<h1>Mini Pinterest le site !</h1>
	</div>
	<p>
		<form class="w3-container w3-center" action="Accueil.php" method="post">
			<label for="categorie">Choisissez une catégorie </label>
			<select name="Categorie" id="categorie">
				<option value="TOUT">Tout</option>
				<option value="Fruit">Fruits</option>
				<option value="Legume">Legumes</option>
			</select>
			<input type="submit" name="afficher" value="Afficher"/>
			<br /><br />
			<label for="recherche">Rechercher une image : </label>
			<input type ="text" name="recherche" id="recherche" placeholder="Rechercher ..."/>
			<input type="submit" name="rechercher" value = "Go!"/ >
			
		</form>
		<br /> 
		<?php 
		$link=getConnection(); 
		if(isset($_POST['Categorie'])) {
			if($_POST['Categorie'] == "TOUT") {
				echo "<h2>Toutes les photos</h2>";	
				afficherTout($link);		
			}
			else {
				echo "<h2>Toutes les " . $_POST['Categorie'] . "s</h2>";
				afficherCategorie($link,$_POST['Categorie']);
			}		
		}		
		elseif(isset($_POST['rechercher'])) {
			echo "Résultat de la recherche pour : " . $_POST['recherche'];
			afficherRecherche($link, $_POST['recherche']);
		}
		else {
			echo "<h2>Toutes les photos</h2>";			
			afficherTout($link);		
		}
		
		
		?>
	</p>

	</body>
</html>
