<?php
require_once('Connexion.php');
function afficherImage($nomFich){
	echo "<img src='assets/images/".$nomFich."'>";
}
function afficherTout($link){
	$requete = executeQuery($link, "SELECT nomFich FROM photo");
	while($resultat = mysqli_fetch_array($requete)){
		afficherImage($resultat['nomFich']);
	}
}
?>