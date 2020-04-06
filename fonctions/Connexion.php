<?php

/*Cette fonction prend en entrée l'identifiant de la machine hôte de la base de données, les identifiants (login, mot de passe) d'un utilisateur autorisé 
sur la base de données contenant les tables pour le chat et renvoie une connexion active sur cette base de donnée. Sinon, un message d'erreur est affiché.*/
function getConnection()
{
	$dbHost = "localhost";// à compléter
	$dbUser = "root";// à compléter
	$dbPwd = "";// à compléter
	$dbName = "mini-pinterest";
	$link = mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);
	if (!$link) {
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
	        echo "Erreur de débogage : " . mysqli_connect_errno() . PHP_EOL;
	        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	else{
		return $link;
	}
}


/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL SELECT et renvoie les résultats de la requête. Si le résultat est faux, un message d'erreur est affiché*/
function executeQuery($link, $query)
{
 
	 if ($resultat = mysqli_query($link, $query, MYSQLI_USE_RESULT)) {
		 	return $resultat;
			mysqli_free_result($res);
		}
		else {
			printf("Erreur : %s\n", mysqli_error($link));
		}
}

function tableauQuery($requete){
	$tab = array();
	while ($resultat = mysqli_fetch_array($requete)){
		$tab[]=$resultat[0];
	}
	return $tab;
}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL INSERT/UPDATE/DELETE et ne renvoie rien si la mise à jour a fonctionné, sinon un 
message d'erreur est affiché.*/
function executeUpdate($link, $query)
{
	echo "req: $query";
	if($link == NULL){
		printf("Echec de update (connexion)");
	}
	if (!mysqli_query($link, $query)) {
			echo "Error updating record: " . mysqli_error($link);
		}
}

/*Cette fonction ferme la connexion active $link passée en entrée*/
function closeConnexion($link)
{

	mysqli_close($link);

}
?>