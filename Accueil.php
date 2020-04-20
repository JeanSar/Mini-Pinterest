<!DOCTYPE html>
	<?php
		require_once('./fonctions/Image.php');
		require_once('./fonctions/Connexion.php');
	?>
<html>
	<head>
		<title>Mini Pinterest</title>
	</head>
	<body>
	<h1>Mini Pinterest le site !</h1>
	<p>
		<form action="Accueil.php" method="post">
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
