<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
$link=getConnection();

function Categorie(){
	$link=getConnection();
	if(isset($_POST['Categorie'])) {
			if($_POST['Categorie'] == "TOUT") {
				
				if(isset($_SESSION['logged'])){
					if($_SESSION['droit']){
						echo "<h2>Toutes les photos</h2>";
						afficherTout($link);
					}
						
					else{
						echo "<h2>Toutes vos photos</h2>";
						afficherToutUtilisateur($link,$_SESSION['logged']);
					}
				}
				else{
						afficherTout($link);
				}
			}
			else {
				echo "<h2>Toutes les " . $_POST['Categorie'] . "s</h2>";
				if(isset($_SESSION['logged'])){
					if ($_SESSION['droit']){
						afficherCategorie($link,$_POST['Categorie']);}
					else afficherCategorieUtilisateur($link,$_POST['Categorie'], $_SESSION['logged']);
					}
				else{
					afficherCategorie($link,$_POST['Categorie']);
				}
			}
		}
	}

function Recherche(){
	$link=getConnection();
	if (isset($_POST['rechercher'])){
			$_recherche = htmlspecialchars($_POST['recherche']);
			echo "Résultat de la recherche pour : " . $_recherche;
			if($_SESSION['droit']){
				afficherRecherche($link, $_recherche);}
			else{
					afficherRechercheUtilisateur($link,$_recherche,$_SESSION['logged']);
				}
			}
		else {
				if(!isset($_POST['Categorie'])){
					if(isset($_SESSION['logged'])){
						if($_SESSION['droit']){
							echo "<h2>Toutes les photos</h2>";
							afficherTout($link);
						}
						else{
							echo "<h2>Toutes vos photos</h2>";
							afficherToutUtilisateur($link,$_SESSION['logged']);
						}
					}
					else{
					afficherTout($link);
				}
			}
		}
	}
function formulaireConnexion(){
	$link=getConnection();
	if((isset($_POST['deco'])) and isset($_SESSION['logged'])){
					unset($_SESSION['logged']);
					session_destroy();
					
				}
				$link=getConnection();
				if (!isset($_SESSION["logged"])){
					if(!isset($_POST['pseudo'])){
						echo "<form action='Accueil.php' method='post'>
							<label for='id'>Identifiant : </label>
							<input type ='text' name='pseudo' id='id' placeholder='Saisir ...' required/>
							<label for='psswd'>Mot de Passe : </label>
							<input type ='password' name='psswd' id='psswd' placeholder='Saisir ...' required/>
							<input  class='w3_button w3-teal' type='submit' name='connexion' value = 'Se connecter'/ >
							</form>";
					}	
					else{
						$_SESSION['debut']=$_SERVER['REQUEST_TIME'];
						$requete=executeQuery($link, "SELECT Nom, motdepasse,droit FROM utilisateur WHERE pseudo = '".$_POST['pseudo']."'");
						$resultat=mysqli_fetch_array($requete);
						$chaine = ((string)($resultat['motdepasse']));
						$requete->close();
						$link->next_result();
						if(($chaine==$_POST['psswd'])and $requete){
							$_SESSION["logged"]=$resultat['Nom'];
							$_SESSION['temps']=$_SERVER['REQUEST_TIME']-$_SESSION['debut'];
							$seconde=$_SESSION['temps']%60;
							$minute=($_SESSION['temps']-$seconde)/60;
							echo "Temps de connexion : ".$minute." minute(s) ".$seconde." seconde(s)"."<br>";
							echo $_SESSION["logged"];
							echo "<br>";
							$_SESSION['droit']=$resultat['droit'];
							echo "<a href='Ajouter.php' >Ajouter une image</a>";
							echo "<form action='Accueil.php' method='post'>
									<input type='submit' value='Se déconnecter' name='deco'>
								</form>";
							}
						else{ 
							echo "Mauvais mot de passe ou pseudo";
							echo "<form action='Accueil.php' method='post'>
							<label for='id'>Identifiant : </label>
							<input type ='text' name='pseudo' id='id' placeholder='Saisir ...' required/>
							<label for='psswd'>Mot de Passe : </label>
							<input type ='password' name='psswd' id='psswd' placeholder='Saisir ...' required/>
							<input  class='w3_button w3-teal' type='submit' name='connexion' value = 'Se connecter'/ >
							</form>";
						
						
						$requete->close();
						$link->next_result();}
						}
					}
			else{
				$_SESSION['temps']=$_SERVER['REQUEST_TIME']-$_SESSION['debut'];
				$seconde=$_SESSION['temps']%60;
				$minute=($_SESSION['temps']-$seconde)/60;
				echo "Temps de connexion : ".$minute." minute(s) ".$seconde." seconde(s)"."<br>";
				echo $_SESSION["logged"];
				echo "<br>";
				echo "<a href='Ajouter.php' >Ajouter une image</a>";
				echo "<form action='Accueil.php' method='post'>
						<input type='submit' value='Se déconnecter' name='deco'>
						</form>";
			}
}
