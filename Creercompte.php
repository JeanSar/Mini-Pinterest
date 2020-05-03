<!DOCTYPE html>
<?php
  require_once('./fonctions/Image.php');
  require_once('./fonctions/Connexion.php');
  require_once('./fonctions/Affichage.php');

?>
<html>
	<title>Mini Pinterest</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<link rel="stylesheet" href="style.css">
	<head>
		<div class='w3-container w3-teal w3-center'>
			<h1>Mini Pinterest le site !</h1>
		</div>
	</head>
	<body style='text-align: center;'>

    <form action='Creercompte.php' method='post'>
      <fieldset>
        <legend> <h2> Se créer un nouveau compte Mini Pinterest : </h2> </legend>
        <label for="nom">Choisissez un nom :</label> <br />
        <input type="text" id="nom" name="nom" placeholder="Saisir un nom ..." required>  <br /> <br />
        <label for="id">Choisissez un pseudo (identifiant de session) :</label> <br />
        <input type="text" id="id" name="id" placeholder="Saisir un pseudo ..." required>  <br /> <br />
        <label for="mdp">Choisissez un mot de passe :</label> <br />
        <input type="password" id="mdp" name="mdp" placeholder="Saisir un mot de passe..." pattern=".{8,}" title="doit contenir au moins 8 caractères" required >  <br /> <br />
        <input type="checkbox" id="agree" name="agree" required>
        <label for id="agree"> I swear I agree Privacy Terms </label> <br /> <br />
        <input type="submit" class='w3_button w3-teal' name="submit" value="Créer votre compte">
      </fieldset>
    </form>
	</body>
  <?php
    $link=getConnection();
    if(isset($_POST["submit"])) {
      $nom = htmlspecialchars($_POST["nom"]);
      $id = htmlspecialchars($_POST["id"]);
      $mdp = htmlspecialchars($_POST["mdp"]);
      executeQuery($link, "INSERT INTO utilisateur(droit, Nom, pseudo, motdepasse) VALUES ('0','" . $nom . "','" . $id ."','" . $mdp ."');");
      echo "Votre compte Mini Pinterest : <b>\"" . $id . "\"</b> viens d'être créé ! <br />";
      echo "Cliquer <a href='Accueil.php'>ICI</a> pour être redirigé sur la page d'acceuil. <br />";
      echo "Vous devrez alors vous connecter pour acceder à votre compte.";

    }
  ?>
</html>
