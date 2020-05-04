<!DOCTYPE html>
<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
require_once('./fonctions/Affichage.php');
session_start();
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
	//Pour accéder à cettte page, il faut avoir cliqué sur une image, si ce n'est pas le cas vous retournez à l'accueil directement
?>
<html>
	<title>Mini Pinterest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="style.css">
	<head>
		<div class="w3-container w3-teal w3-center">
			<h1>Mini Pinterest le site !</h1>
			<?php
				formulaireConnexion(); //Formulaire pour se connecter, redirige à l'accueil, si vous l'êtes déjà
									//affiche que vous êtes connecté
				formulaireCreerCompte();
			?>
			<br />
			<a href="Accueil.php" >Retourner à l'accueil</a>
		</div>
	</head>
	<body>
	<br />
	<?php
		$nomImage=$_POST['image'];
		afficherImage($nomImage);
		$requete = executeQuery($link,"SELECT P.titre, P.description, C.nomCat FROM `photo` P NATURAL JOIN `categorie` C WHERE `nomFich`='{$nomImage}'");
		$tab = mysqli_fetch_array($requete);
		//Affiche nom de l'image et sa catégorie qui est un lien vers toutes les images de sa catégorie
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
					//Si l'image est publique, affiche Cacher pour la rendre privée, bouton Modifier redirige 
					//vers la page Modifier.php
					echo "<form  method='post' action='resultat.php'>
						<input type='hidden' value='".$nomImage."' name='Cacher'>
						<input class='w3_button w3-teal' type='submit' value='Cacher'>
						</form>";
					echo "<form  method='post' action='Modifier.php'>
						<input type='hidden' value='".$nomImage."' name='Modifier'>
						<input class='w3_button w3-teal' type='submit' value='Modifier'>
						</form>";
				}
			}
			$requete->close();
			$link->next_result();
			$requete = executeQuery($link,"SELECT nomFich FROM photo WHERE afficher = 0 AND Nom='".$_SESSION["logged"]."'");
			$resultat = tableauQuery($requete);
			if(!empty($resultat)){
					//Si l'image est publique, affiche Cacher pour la rendre publique, bouton Modifier redirige 
					//vers la page Modifier.php
				if(in_array($nomImage, $resultat)){
					echo "<form  method='post' action='resultat.php'>
						<input type='hidden' value='".$nomImage."' name='Afficher'>
						<input class='w3_button w3-teal' type='submit' value='Rendre public'>
						</form>";
					echo "<form  method='post' action='Modifier.php'>
						<input type='hidden' value='".$nomImage."' name='Modifier'>
						<input class='w3_button w3-teal' type='submit' value='Modifier'>
						</form>";
				}
			}
			$requete->close();
			$link->next_result();
			$requete = executeQuery($link,"SELECT Nom FROM photo WHERE nomFich='".$nomImage."'");
			$resultat = mysqli_fetch_array($requete);
			if($resultat['Nom']==$_SESSION['logged']){ 
				//Permet de supprimer uniquement les images qui vous appartiennent
				echo "<form  method='post' action='resultat.php'>
					<input type='hidden' value='".$nomImage."' name='supprimer'>
					<input class='w3_button w3-teal' type='submit' value='Supprimer'>
					</form>";
			}
		}
	?>
</body>
</html>
