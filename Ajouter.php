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
			<?php require_once('./fonctions/Affichage.php');
				session_start();
				formulaireConnexion();
			?>
		</div>
	</head>
	<body  style='text-align: center;'>
		<h2> Ajouter une image : </h2>
		<?php

		require_once('./fonctions/Connexion.php');
		if (!isset($_SESSION['logged'])){
			header('Location: Accueil.php');
		}
		$link=getConnection();
		function formulaire($link){ //formulaire pour envoyer une nouvelle image
			$requete = executeQuery($link,"SELECT nomCat FROM categorie");
			echo'<form enctype="multipart/form-data" method="post" action="Ajouter.php">

			<label for="Téléchargement">Télécharger votre fichier svp : </label>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000" required/>
			<input type="file" name="fichier" id="fichier"/> <br>
			<span id="missFichier"></span><br>

            <label for="description">Entrez votre description svp : </label> <br>
            <textarea maxlength="255" name="description" id="description" required></textarea> <br>
            <span id="missDescription"></span><br>

            <label for="Catalogue">Choisissez la catégorie : </label>
			<select name="categorie" id="categorie" required>
				<option value=""></option>';
				while($resultat = mysqli_fetch_array($requete)){ 
					//Récupère toutes les catégories possibles dans la base de données
				echo '<option value="'.$resultat['nomCat'].'">'.$resultat['nomCat'].'</option>';
				}
			echo '</select> <br>
			<span id="missCategorie"></span><br />

            <label for="nom">Nom que vous voulez donner :</label>
            <input type="text" name="nom" id="nom" required><br> <br>
            <input class="w3_button w3-teal" type="submit" value="Valider" id="bouton_envoi">
        </form>';
		}

		if(isset($_POST['description']) and isset($_FILES['fichier']['name']) and isset($_POST['categorie']) and isset($_POST['nom'])){ // Si on a envoyé une image

			$affiche_formulaire=0; //détermine si il faut afficher le formulaire

			if($_POST['categorie']==""){
				echo "<div class='w3-red'><b>Aucune descritpion</b></div><br />";
				$affiche_formulaire=1;
			}

			if($_POST['description']==""){
				echo "<div class='w3-red'><b>Aucune catégorie choisie</b></div><br />";
				$affiche_formulaire=1;
			}

			if($affiche_formulaire==1)
				formulaire($link);
			if($affiche_formulaire==0 and isset($_FILES['fichier'])){ 
				//Si on a bien envoyé un fichier et qu'on n'a pas besoin d'afficher le formulaire on vérifie
				//que l'extension et la taille sont bonnes
				$ext = array ('jpeg', 'gif', 'png');
				$extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
				if ($_FILES['fichier']['error']){ //Vérification de la taille
					echo "<div class='w3-red'><b>Votre image est trop volumineuse,</b></div><br>
					 Elle doit faire moins de 100 kilo octets";

					$affiche_formulaire = 1;
					
				}
				if (!(in_array(strtolower($extension), $ext))){ //Vérifie que l'extension est bonne
					echo "<div class='w3-red'><b>Votre image ne possède pas le bonne extension</b></div><br>
								Extensions acceptées : .jpeg ;  .gif ; .png ;
						";
						formulaire($link);

				}
				else{
					if($affiche_formulaire==0){
						$dossier = 'assets/images/';
						$requete = executeQuery($link,"SELECT max(photoId) from photo");
						$resultat=mysqli_fetch_array($requete);
						$chaine=(string)(current($resultat)+1);
						$fichier = "DSC".$chaine.".".pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION); //récupère extension du fichier
						$requete->close();
						$link->next_result();
						if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
						{
							$requete=executeQuery($link,"SELECT catId from categorie WHERE
							nomCat='".$_POST['categorie']."'");
							$categorie=(string)(current(mysqli_fetch_array($requete)));
							$requete->close();
							$link->next_result();
							//echo 'Upload effectué avec succès !';
							if (isset($_SESSION["logged"])){
								executeUpdate($link, "INSERT INTO photo (nomFich,description,catId,titre,Nom) values ('".$fichier."','".$_POST['description']."','".$categorie."','".$_POST['nom']."','".$_SESSION["logged"]."')"); //Si connecté remplit la base de données

							}
							else{
								executeUpdate($link, "INSERT INTO photo values 	('".$chaine."','".$fichier."','".$_POST['description']."','".$categorie."','".$_POST['nom']."','Dieu');"); //par défaut c'est l'admin qui rajoute une image si il ya un problème avec la session de l'utilisateur
							}
							header('Location: Accueil.php'); //Redirige sur l'accueil après avoir téléversé l'image
							}
						}
						else{
							formulaire($link);
						}
					}
			}
				else //Sinon (la fonction renvoie FALSE).
     			{
					echo 'Echec de l\'upload !';
				}
			}

		else{
			
			formulaire($link);
		}

		?>
	<br> <br>
	<a href="Accueil.php" >Retourner à l'accueil</a>
	</body>
</html>
