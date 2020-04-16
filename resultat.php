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
		echo "<br />".$nomImage. "<br />";
		echo $tab['nomCat']. "<br />";
		echo $tab['description'];
		
	?>
</head>
<body>