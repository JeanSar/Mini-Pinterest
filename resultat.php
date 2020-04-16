<!DOCTYPE html>
<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
?>
<html>
<head>
<title></title>
	<?php 
		$link=getConnection();
		$nomImage=current($_POST);
		afficherImage($nomImage);
		$requete = executeQuery($link,"SELECT P.description, C.nomCat FROM `photo` P NATURAL JOIN `categorie` C WHERE `nomFich`='{$nomImage}'");
		$tab = mysqli_fetch_array($requete);
		echo "<br />Nom de l'image : ".$nomImage;
		echo "<form name='Accueil' method='post' action='Accueil.php'>Catégorie : <input type='hidden' value='".$tab['nomCat']."'  name='Categorie'><a href='#' onclick='document.Accueil.submit()'>".$tab['nomCat']."</a></form>";
		echo "Descritpion : ".$tab['description'];
	?>	
</head>
<body>