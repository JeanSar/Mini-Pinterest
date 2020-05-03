<!DOCTYPE html>
<html>
<style>
	table,
	td {
    	border: 1px solid #333;
	}	

</style>
<?php
		require_once('./fonctions/Image.php');
		require_once('./fonctions/Connexion.php');
		require_once('./fonctions/Affichage.php');
		$link=getConnection();
		session_start();
	?>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
		<link rel="stylesheet" href="style.css">
		<head>
		<div class='w3-container w3-teal w3-center'>
			<h1>Mini Pinterest le site !</h1>
			<?php
				formulaireConnexion();
				formulaireCreerCompte();
		?>
		<br>
		<a href="Accueil.php" >Retourner à l'accueil</a>
		</div>
		<?php
		if(!isset($_SESSION['logged'])){
			header('Location: Accueil.php');
		}
		if($_SESSION['droit']==0){
			header('Location: Accueil.php');
		}
		else{
			$requete=executeQuery($link,"SELECT Nom, COUNT(nomFich) as nb FROM photo GROUP BY Nom");
			echo '<table>';
			echo'<tbody>';
			echo'<tr><td>Nom</td><td>Nombre de photos</td>';
			while($resultat=mysqli_fetch_array($requete)){
				echo'<tr>';
				echo '<td>'.$resultat['Nom'].'</td>';
				echo '<td>'.((string)$resultat['nb']).'</td>';
				echo'</tr>';
			}
			echo '</tbody></table><br>';
			$requete=executeQuery($link,"SELECT C.nomCat, COUNT(P.nomFich) as nb FROM photo P NATURAL JOIN categorie C GROUP BY C.nomCat");
			echo '<table>';
			echo'<tbody>';
			echo'<tr><td>Catégorie</td><td>Nombre de photos</td>';
			while($resultat=mysqli_fetch_array($requete)){
				echo'<tr>';
				echo '<td>'.$resultat['nomCat'].'</td>';
				echo '<td>'.((string)$resultat['nb']).'</td>';
				echo'</tr>';
			}
			echo '</tbody></table>';
	   	}
?>
</html>  
