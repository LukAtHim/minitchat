<?php

// Connexion à la base de données

require_once 'connexion.php';

// Démarrage de session

session_start();

// Vérification de l'abscence du pseudo en session et affectation d'une valeur vide
if(!isset($_SESSION['pseudo']))
{
	$_SESSION['pseudo']='';	
}

//Affichage du formulaire

?>

<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="utf-8" />
			<title>Mini-chat amélioré</title>
			<link rel="stylesheet" href="css/style.css">
		</head>
		<body>
			<h1>T.HESS</h1>
			<p class="info"> Identifiez-vous </p>
			<form id="formulaire" action="traitementTchat.php" method="post">
				<table id="champs">
					<tr class="lignes"><td> <label for="pseudo"> Pseudo (25 caractères max) : </label></td> <td> <input type="text" name="pseudo" id="pseudo" value="<?php echo $_SESSION['pseudo']?>" maxlength="25" onClick="this.value=\'\'" required /> </td></tr> 
					
						<!-- onClick="this.value=\'\'" efface le contenu du champ au clic et required pour demander à ce que le champ ne soit pas vide-->
						
					<tr class="lignes"><td> <label for="message"> Message (255 caractères max) : </label></td> <td> <input type="text" name="message" id="message" maxlength="255" required/> </td></tr>
					<tr class="lignes" id="bouton"><td colspan="2"> <input type="submit" value="Envoyer" /> </td></tr>
				</table>
			</form>
				<?php
					// Récupération des 5 derniers messages
					$reponse = $bdd->query('SELECT messages_pseudo,DATE_FORMAT(messages_dateM, \'%d/%m/%Y\') AS date,DATE_FORMAT(messages_dateM, \'%Hh%imin%ss\') AS heure,messages_contenu FROM messages ORDER BY messages_dateM DESC LIMIT 0, 5'); 
				?>
				
				<p class="info"> Liste des 5 derniers messages </p>
				<div id="messages">
				
				<?php
					// Affichage reponse
					while($data = $reponse->fetch()){
				?>
						<p>Le <?php echo $data['date'] ?> à <?php echo $data['heure'] ?> <?php echo $data['messages_pseudo'] ?> à écrit "<?php echo $data['messages_contenu'] ?>" </p>
				<?php
				}
				$reponse->closeCursor();
				?>
		</body>
	</html>