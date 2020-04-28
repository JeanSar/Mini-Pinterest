<!DOCTYPE html>
<html>
<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
require_once('./fonctions/Affichage.php');
session_start();
?>
	<title>Mini Pinterest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<head>
		<div class="w3-container w3-teal w3-center">
			<h1>Mini Pinterest le site !</h1>
			<?php				
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
	if(isset($_POST['Modifier'])){
				afficherImage($_POST['Modifier']);
				echo '<br><br>';
				$requete=executeQuery($link, "SELECT description, catId, titre FROM photo WHERE nomFich='".$_POST['Modifier']."'");
				$resultat=mysqli_fetch_array($requete);
				echo'<form method="post" action="Modifier.php">
			
				<label for="description">Entrez votre description svp : </label>
				<textarea maxlength="255" name="description" id="description" required>'.$resultat['description'].'</textarea>
				<span id="missDescription"></span><br>
            
            	<label for="Catalogue">Choisissez la catégorie : </label>
				<select name="categorie" id="categorie" required>
					<option value=""></option>
					<option value="Fruit">Fruit</option>
					<option value="Légume">Légume</option>
				</select>
				<span id="missCategorie"></span><br />
            
            	<label for="nom">Nom que vous voulez donner :</label>
				<input type="text" name="nom" id="nom" value="'.$resultat['titre'].'" required>
				<input type="hidden" name="nomFich" id="nom" value="'.$_POST['Modifier'].'" required><br>
				<input type="submit" value="Valider" id="bouton_envoi">
				</form>';
		}
	if(isset($_POST['nom'])){
		executeQuery($link, "Update photo SET description='".$_POST['description']."', titre = '".$_POST['nom']."' WHERE nomFich='".$_POST['nomFich']."'");
		header('Location: Accueil.php');
	}
	?>