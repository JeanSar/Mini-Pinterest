<?php
require_once('Connexion.php');
function afficherImage($nomFich){
	echo "<img src='assets/images/".$nomFich."'>";
}

function afficherImageAccueil($nomFich){
	echo "<form action='resultat.php' method='post'><button type='submit'><input type='hidden' value='".$nomFich."'  name='".$nomFich."'><img src='assets/images/".$nomFich."'></input></button></form>";
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
?>
