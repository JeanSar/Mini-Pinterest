<!DOCTYPE html>
<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
require_once('./fonctions/Affichage.php');
	$link=getConnection();
	if(isset($_POST['supprimer'])){
		executeQuery($link,"DELETE FROM `photo` WHERE nomFich='".$_POST['supprimer']."'");
		unlink("assets/images/".$_POST['supprimer']);
		header('Location: Accueil.php');
		}
	if(isset($_POST['Cacher'])){
		executeQuery($link,"Update photo SET afficher = 0  WHERE nomFich='".$_POST['Cacher']."'");
		header('Location: Accueil.php');
		}
	if(isset($_POST['Afficher'])){
		executeQuery($link,"Update photo SET afficher = 1  WHERE nomFich='".$_POST['Afficher']."'");
		header('Location: Accueil.php');
		}
	if(!isset($_POST['image'])){
		header('Location: Accueil.php');
	}

?>
<html>
	<title>Mini Pinterest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<head>
		<div class="w3-container w3-teal w3-center">
			<h1>Mini Pinterest le site !</h1>
			<?php
				session_start();				
				formulaireConnexion();
			?>
		</div>
	</head>
	<body>
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
		$nomImage=$_POST['image'];
		afficherImage($nomImage);
		$requete = executeQuery($link,"SELECT P.titre, P.description, C.nomCat FROM `photo` P NATURAL JOIN `categorie` C WHERE `nomFich`='{$nomImage}'");
		$tab = mysqli_fetch_array($requete);
		echo "<br>
			<br>
			Nom de l'image : ".$tab['titre']."
			<br>
			<form name='Accueil' method='post' action='Accueil.php'>
				Catégorie : <input type='hidden' value='".$tab['nomCat']."'  name='Categorie'>
				<a href='#' onclick='document.Accueil.submit()'>
					".$tab['nomCat']."
				</a>
				
			</form>
			Descritpion : ".$tab['description'];
		$requete->close();
		$link->next_result();
		if(isset($_SESSION["logged"])){
			$requete = executeQuery($link,"SELECT nomFich FROM photo WHERE afficher = 1 AND Nom='".$_SESSION["logged"]."'");
			$resultat = tableauQuery($requete);
			if(!empty($resultat)){
				if(in_array($nomImage, $resultat)){
					echo "<form  method='post' action='resultat.php'>
						<input type='hidden' value='".$nomImage."' name='Cacher'>
						<input type='submit' value='Cacher'>
						</form>";
				}
			}
			$requete->close();
			$link->next_result();
			$requete = executeQuery($link,"SELECT nomFich FROM photo WHERE afficher = 0 AND Nom='".$_SESSION["logged"]."'");
			$resultat = tableauQuery($requete);
			if(!empty($resultat)){
				if(in_array($nomImage, $resultat)){
					echo "<form  method='post' action='resultat.php'>
						<input type='hidden' value='".$nomImage."' name='Afficher'>
						<input type='submit' value='Rendre public'>
						</form>";
				}
			}
			echo "<form  method='post' action='resultat.php'>
				<input type='hidden' value='".$nomImage."' name='supprimer'>
				<input type='submit' value='Supprimer'>
				</form>";
		}
	?>
</body>
</html>
