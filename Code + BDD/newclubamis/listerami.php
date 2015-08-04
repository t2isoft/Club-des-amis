<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister les amis</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Lister les amis</h3>
<form action="listerami.php" method="POST">
<br>
</form>
</center>
<?php

connexion();


$sql1="select * from amis where date_sortie='0000-00-00' order by nom_amis";
$resultat=mysql_query($sql1) or die('erreur dans le requete');
echo "<center> <b>Il y a ".mysql_num_rows($resultat)." Ami(s)</b></center>";
?>
<center>
<div class="tableau">
	<table>
	<tr><td>Nom Amis</td><td>Prénom Amis</td><td>Date Entrée</td><td>Téléphone fixe</td><td>Téléphone portable</td>
	<td>Email</td><td>Numéro de la rue</td><td>Nom de la rue</td><td>Code Postal</td><td>Ville</td><td>Parrain 1</td><td>Parrain 2</td>
	<td>Modifier / Supprimer</td></tr>
<?php
while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
	<tr><td><?php echo $enreg['nom_amis']; ?></td>
	<td><?php echo $enreg['prenom_amis']; ?></td>
	<td><?php echo $enreg['date_entree']; ?></td>
	<td><?php echo $enreg['tel_fixe']; ?></td>
	<td><?php echo $enreg['tel_port']; ?></td>
	<td><?php echo $enreg['email']; ?></td>
	<td><?php echo $enreg['num_adr']; ?></td>
	<td><?php echo $enreg['rue_adr']; ?></td>
	<td><?php echo $enreg['cp_adr']; ?></td>
	<td><?php echo $enreg['ville_adr']; ?></td>
	<td><?php echo $enreg['parrain1']; ?></td>
	<td><?php echo $enreg['parrain2']; ?></td>
	<td><a href="modifierami.php?reference=<?php echo $enreg['id_amis'];?>">Modifier</a> 
	&nbsp;<a href="supprimerami.php?reference=<?php echo $enreg['id_amis'];?>">Supprimer</a></td>
	</tr>
</div>
<?php
} // fin de while
echo "</table>";
deconnexion();
?>
</body>
</html>
