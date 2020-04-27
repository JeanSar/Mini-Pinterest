<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Quelle photo ?</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<a href="Accueil.php" >Retourner à l'accueil</a>
		<?php

		require_once('./fonctions/Connexion.php');
		$link=getConnection();
		function formulaire(){
			echo'<form enctype="multipart/form-data" method="post" action="Ajouter.php">
			
			<label for="Téléchargement">Télécharger votre fichier svp : </label>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000" required/>
			<input type="file" name="fichier" id="fichier"/>
			<span id="missFichier"></span><br>
			
            <label for="description">Entrez votre description svp : </label>
            <textarea maxlength="255" name="description" id="description" required></textarea>
            <span id="missDescription"></span><br>
            
            <label for="Catalogue">Choisissez la catégorie : </label>
			<select name="categorie" id="categorie" required>
				<option value=""></option>
				<option value="Fruit">Fruit</option>
				<option value="Légume">Légume</option>
			</select>
			<span id="missCategorie"></span><br />
            
            <label for="nom">Nom que vous voulez donner :</label>
            <input type="text" name="nom" id="nom" required><br>
            <input type="submit" value="Valider" id="bouton_envoi">
        </form>';
		}
		
		if(isset($_POST['description']) and isset($_FILES['fichier']['name']) and isset($_POST['categorie']) and isset($_POST['nom'])){
			
			$affiche_formulaire=0;
			
			if($_POST['categorie']==""){
				echo "Aucune descritpion<br />";
				$affiche_formulaire=1;
			}

			if($_POST['description']==""){
				echo "Aucune catégorie choisie <br />";
				$affiche_formulaire=1;
			}
			
			if($affiche_formulaire==1)
				formulaire();
			if($affiche_formulaire==0 and isset($_FILES['fichier'])){ 
				$dossier = 'assets/images/';
				$requete = executeQuery($link,"SELECT max(photoId) from photo");
				$resultat=mysqli_fetch_array($requete);
				$chaine=(string)(current($resultat)+1);
				$fichier = "DSC".$chaine.".".pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
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
					executeUpdate($link, "INSERT INTO photo values ('".$chaine."','".$fichier."','".$_POST['description']."','".$categorie."','".$_POST['nom']."','admin')");
					header('Location: Accueil.php');
				}
				else //Sinon (la fonction renvoie FALSE).
     			{
					echo 'Echec de l\'upload !';
				}
			}	
		}
		else{
			formulaire();
		}
		?>
		
		
	</body>
</html>