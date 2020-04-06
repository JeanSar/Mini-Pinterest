<!DOCTYPE html>
<?php
require_once('./fonctions/Image.php');
require_once('./fonctions/Connexion.php');
?>
<html>
<head>
<title></title>
</head>
<body>
<h1>Toutes les photos</h1>
	
<?php $link=getConnection(); 
			afficherTout($link);
	?>
<p></p>

</body>
</html>