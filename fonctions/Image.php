<html>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="style.css">

<?php
require_once('Connexion.php');
function afficherImage($nomFich){
	echo "<img src='assets/images/".$nomFich."'";
}

function afficherImageAccueil($nomFich){
	echo "<form action='resultat.php' method='post' class='w3-card-4' style='width:25%'>
			<label for='select'>
					<input type='image' id='image' alt='Login'
					src='assets/images/".$nomFich."' style='width:100%; display:inline-block;'></label>
					<div class='w3-container w3-center'>
					</div>
			<input type='hidden' value='".$nomFich."'  name='"."image"."'>
			</form>";
}

function afficherTout($link){ //affiche toutes les images
	$requete = executeQuery($link, "SELECT nomFich FROM photo WHERE afficher = 1");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}
}
function afficherToutUtilisateur($link, $nom){ //Affiche les images de l'utilisateur
	$requete = executeQuery($link, "SELECT nomFich FROM photo WHERE Nom='".$nom."'");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}
}

function afficherCategorie($link,$categorie){
	$requete = executeQuery($link, "SELECT nomFich 
					FROM photo 
					JOIN categorie 
					ON categorie.catId = photo.catId
					WHERE afficher = 1 AND nomCat LIKE \"". $categorie ."\"");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}
}
	
function afficherCategorieUtilisateur($link,$categorie, $nom){
	$requete = executeQuery($link, "SELECT nomFich 
					FROM photo 
					JOIN categorie 
					ON categorie.catId = photo.catId
					WHERE nomCat LIKE '".$categorie."' and Nom='".$nom."'");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}
}
	
function afficherRecherche($link,$recherche){
	$requete = executeQuery($link, "SELECT nomFich
					FROM photo
					WHERE afficher = 1 AND titre LIKE \"%". $recherche ."%\"");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}

}
	
function afficherRechercheUtilisateur($link,$recherche,$nom){
	$requete = executeQuery($link, "SELECT nomFich
					FROM photo
					WHERE Nom='".$nom."' AND titre LIKE \"%". $recherche ."%\"");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImageAccueil($resultat['nomFich']);
	}

}	
?>

</html>
