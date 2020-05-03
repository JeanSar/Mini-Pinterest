<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
$link=getConnection();

function Categorie(){
	$link=getConnection();
	if(isset($_POST['Categorie'])) {
			if($_POST['Categorie'] == "TOUT") {
				if(isset($_SESSION['logged'])){
					echo "<h2>Toutes vos photos</h2>";
					afficherToutUtilisateur($link,$_SESSION['logged']);
					}
					else{
						echo "<h2>Toutes les photos</h2>";
						afficherTout($link);
					}
				}
				else{
					echo "<h2>Toutes les photos de ".$_POST['Categorie'] . "s : </h2>";
					if(isset($_SESSION['logged'])){
						afficherCategorie($link,$_POST['Categorie']);
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
			afficherRecherche($link, $_recherche);}
		else {
				if(!isset($_POST['Categorie'])){
					if(isset($_SESSION['logged'])){
							echo "<h2>Toutes vos photos</h2>";
							afficherToutUtilisateur($link,$_SESSION['logged']);
						}
					else{
						echo "<h2>Toutes les photos</h2>";
						afficherTout($link);
				}
			}
		}
	}
function afficherStat(){
	if(isset($_SESSION['logged'])){
		if($_SESSION['droit'] == 1){
			echo '<a href="Statistique.php" >Voir les statistiques</a>';
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
							$pseudo = htmlspecialchars($_POST['pseudo']);
							$requete=executeQuery($link, "SELECT Nom, motdepasse,droit FROM utilisateur WHERE pseudo = '".$pseudo."'");
							$resultat=mysqli_fetch_array($requete);
							$chaine = ((string)($resultat['motdepasse']));
							$requete->close();
							$link->next_result();
							$password = htmlspecialchars($_POST['psswd']);
							if(($chaine==$password)and $requete){
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
								echo "<a href='Photo.php' >Voir toutes les photos</a><br>";
								echo "<a href='Mdp.php' >Changer de mot de passe</a>";
								}
							else{
								echo "<div class='w3-red'><b>Mauvais mot de passe ou pseudo</b></div>";
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
					echo "<a href='Photo.php' >Voir toutes les photos</a><br>";
					echo "<a href='Mdp.php' >Changer de mot de passe</a>";
		}
}
function formulaireCreerCompte(){
	if(!isset($_SESSION['logged'])){
	echo "OU <br />";
	echo "<form action='Creercompte.php'>
						<input class='w3_button w3-teal' type='submit' value='Créer un compte'>
				</form>
	";
	}
}
