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
	</head>
	<body style='text-align: center;'>

		<form action='Mdp.php' method='post'>
			<fieldset>
				<legend> <h2> Modifier votre de mot de passe : </h2> </legend>
				<label>Vous allez modifier le mot de passe de votre compte mini-pinterest : <?php echo $_SESSION['pseudo']; ?><label> <br />
				<label for="mdp">Saisir votre mot de passe actuel :</label> <br />
				<input type="password" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" required>  <br /> <br />
				<label for="newmdp">Choisissez un nouveau mot de passe :</label> <br />
				<input type="password" id="newmdp" name="newmdp" placeholder="Saisir un nouveau mot de passe..." pattern=".{8,}" title="doit contenir au moins 8 caractères" required >  <br /> <br />
				<input type="submit" class='w3_button w3-teal' name="submit" value="Valider la modification">
			</fieldset>
		</form>
	</body>
	<?php
		if(isset($_POST["submit"])) {
			$mdp = htmlspecialchars($_POST["mdp"]);
			$newmdp = htmlspecialchars($_POST["newmdp"]);
			$truemdp = executeQuery($link, "SELECT motdepasse FROM utilisateur WHERE pseudo='" . $_SESSION['pseudo'] . "';");
			$resultat= mysqli_fetch_array($truemdp);
			if($mdp == $resultat['motdepasse']) {
				$truemdp->close();
				$link->next_result();
				executeQuery($link, "UPDATE utilisateur SET motdepasse ='" . ((string) $newmdp) ."' WHERE pseudo='". $_SESSION['pseudo'] ."';");
				echo "<b>Votre mot de passe a bien été changé </b>";
			}
			else {
				echo "<b>Votre mot de passe actuel n'est pas celui-çi</b>";
			}
		}
	?>
</html>
