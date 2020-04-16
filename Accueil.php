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
		<form action="Accueil.php" method="post">
			<select name="Categorie">
				<option value="">All</option>
				<option value="Fruit">Fruits</option>
			</select>
			<input type="submit" />
		</form>
		<br />
	<?php 
		$link=getConnection(); 
		if(!isset($_POST['Categorie'])) {
			echo "<h2>Toutes les photos</h2>";			
			afficherTout($link);		
		}
		elseif(	$_POST['Categorie'] == "") {
			echo "<h2>Toutes les photos</h2>";	
			afficherTout($link);		
		}
		else {
			echo "<h2>Toutes les " . $_POST['Categorie'] . "s</h2>";
			afficherCategorie($link,$_POST['Categorie']);
		}
		
	?>
	<p></p>

	</body>
</html>
