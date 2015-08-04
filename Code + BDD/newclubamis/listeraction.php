<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister les actions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Lister les actions</h3>

	<form action="listeraction.php" method="POST">
	<br>
	</form>
	</center>
<?php

connexion();
$sql1="select * from action, amis, commission 
where action.id_amis=amis.id_amis
and action.id_com=commission.id_com order by nom_action";
$resultat=mysql_query($sql1) or die('erreur dans le requete');
echo "<center> <b> Il y a ".mysql_num_rows($resultat)." Action(s) </b> </center>";
?>
	<center>
<div class="tableau">
	<table>
	<tr><td>Nom Action</td><td>Date de début</td><td>Date de fin</td><td>Fonds collectés</td><td>Commission pilote</td><td>Responsable</td><td>Modifier / Supprimer</td></tr>
<?php
while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
	<tr><td><?php echo $enreg['nom_action']; ?></td>
	<td><?php echo $enreg['date_debut']; ?></td>
	<td><?php echo $enreg['date_fin']; ?></td>
	<td><?php echo $enreg['fonds_col']; ?></td>
	<td><?php echo $enreg['nom_com']; ?></td>
	<td><?php echo $enreg['nom_amis']; ?></td>
	<td><a href="modifieraction.php?reference=<?php echo $enreg['id_action'];?>">Modifier</a> 
	&nbsp;<a href="supprimeraction.php?reference=<?php echo $enreg['id_action'];?>">Supprimer</a></td>
	</tr>
</div>
<?php
} // fin de while
echo "</table>";
deconnexion();
?>
</body>
</html>
