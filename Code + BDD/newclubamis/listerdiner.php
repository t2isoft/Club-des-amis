<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister les diners</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Lister les diners</h3>
<form action="listerdiner.php" method="POST">
<br>
</form>
</center>
<?php

connexion();
$sql1="select * from diner order by date_diner";
$resultat=mysql_query($sql1) or die('erreur dans la requete');
echo "<center> <b>Il y a ".mysql_num_rows($resultat)." Dîner(s)</b></center>";
?>
<center>
<div class="tableau">
	<table>
<tr ><td>Date Dîner</td><td>Lieu Dîner</td><td>Prix Dîner</td><td>Modifier / Supprimer</td></tr>
<?php
while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
<tr><td><?php echo $enreg['date_diner']; ?></td>
<td><?php echo $enreg['lieu_diner']; ?></td>
<td><?php echo $enreg['prix_diner']; ?></td>
<td><a href="modifierdiner.php?reference=<?php echo $enreg['id_diner'];?>">Modifier</a> 
&nbsp;<a href="supprimerdiner.php?reference=<?php echo $enreg['id_diner'];?>">Supprimer</a></td>
</tr>
<?php
} // fin de while
echo "</table>";
deconnexion();
?>
</div>
</body>
</html>
