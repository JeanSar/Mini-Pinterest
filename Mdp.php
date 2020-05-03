<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Quelle photo ?</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
		<link rel="stylesheet" href="style.css">

		<div class='w3-container w3-teal w3-center'>
			<h1>Mini Pinterest le site !</h1>
			<?php
				require_once('./fonctions/Image.php');
				require_once('./fonctions/Connexion.php');
				require_once('./fonctions/Affichage.php');
				session_start();
			if(isset($_SESSION['logged'])){
				$link=getConnection();
				formulaireConnexion();
				formulaireCreerCompte();
				echo '<br>';
				afficherStat();
			}
			else{
				header('Location: Accueil.php');
			}
		?>
		<br>
		<a href="Accueil.php" class="bouton-relief">Revenir à l'accueil</a>
		</div>
		<?php
			$link=getConnection();
			afficherImage($_POST['Modifier']);
			echo '<br><br>';
			$requete=executeQuery($link, "SELECT P.description, C.nomCat, P.titre FROM photo P NATURAL JOIN categorie C WHERE nomFich='".$_POST['Modifier']."'");
			$resultat=mysqli_fetch_array($requete);
			$requete->close();
			$link->next_result();
			$requete1 = executeQuery($link,"SELECT nomCat FROM categorie WHERE nomCat !='".$resultat['nomCat']."'");
			echo'<form method="post" action="Modifier.php">
			
			<label for="description">Entrez votre description svp : </label>
			<textarea maxlength="255" name="description" id="description" required>'.$resultat['description'].'</textarea>
			<span id="missDescription"></span><br>
            
            <label for="Catalogue">Choisissez la catégorie : </label>
			<select name="categorie" id="categorie" required>';
			echo '<option value="'.$resultat['nomCat'].'">'.$resultat['nomCat'].'</option>';
			while($resultat1 = mysqli_fetch_array($requete1)){
					echo '<option value="'.$resultat1['nomCat'].'">'.$resultat1['nomCat'].'</option>';
					echo $resultat1['nomCat'];
				}
				$requete->close();
				$link->next_result();
				echo '</select>
				<span id="missCategorie"></span><br />
            
            	<label for="nom">Nom que vous voulez donner :</label>
				<input type="text" name="nom" id="nom" value="'.$resultat['titre'].'" required>
				<input type="hidden" name="nomFich" id="nom" value="'.$_POST['Modifier'].'" required><br>
				<input type="submit" value="Valider" id="bouton_envoi">
				</form>';
		?>
	</head>
</html>