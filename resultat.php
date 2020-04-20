<!DOCTYPE html>
<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
?>
<html>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="Acceuil.css">
<head>
<title></title>
	<style type="text/css">
		a.bouton-relief {
  			color: white;
  			background-color: #000080;
			text-decoration: none;
			text-align: center;
			padding: 5px;
  			border: 2px outset #c0c0c0;
		}
		a.bouton-relief:hover {
  			background-color: #6495ED;
  			border: 2px inset #c0c0c0;
		}	
	</style>
	<a href="Accueil.php" class="bouton-relief">Index</a>
	<br />
	<?php 
		$link=getConnection();
		$nomImage=current($_POST);
		afficherImage($nomImage);
		$requete = executeQuery($link,"SELECT P.titre, P.description, C.nomCat FROM `photo` P NATURAL JOIN `categorie` C WHERE `nomFich`='{$nomImage}'");
		$tab = mysqli_fetch_array($requete);
		echo "<br />
			Nom de l'image : ".$tab['titre']."
			<br />
			<form name='Accueil' method='post' action='Accueil.php'>
				Catégorie : <input type='hidden' value='".$tab['nomCat']."'  name='Categorie'>
				<a href='#' onclick='document.Accueil.submit()'>
					".$tab['nomCat']."
				</a>
			</form>
			Descritpion : ".$tab['description'];
	?>	
</head>
<body>
</html>