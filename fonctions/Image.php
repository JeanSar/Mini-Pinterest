<html>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="style.css">

<?php
require_once('Connexion.php');
function afficherImage($nomFich){
	echo "

		<img src='assets/images/".$nomFich."'>

		";
}

function afficherImageAccueil($nomFich){
	echo "<form action='resultat.php' method='post' class='w3-card-4' style='width:25%'>
			<label for='select'>
					<img src='assets/images/".$nomFich."' style='width:100%'></label>
					<div class='w3-container w3-center'>
					</div>
			<button id='select' type='submit'>
			<input type='hidden' value='".$nomFich."'  name='".$nomFich."'>
			</input>
			</button>
			</form>";
}

function afficherTout($link){
	$requete = executeQuery($link, "SELECT nomFich FROM photo");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}
}
function afficherCategorie($link,$categorie){
	$requete = executeQuery($link, "SELECT nomFich
					FROM photo
					JOIN categorie
					ON categorie.catId = photo.catId
					WHERE nomCat LIKE \"". $categorie ."\"");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}

}
function afficherRecherche($link,$recherche){
	$requete = executeQuery($link, "SELECT nomFich
					FROM photo
					WHERE titre LIKE \"%". $recherche ."%\"");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}

}
?>

</html>
