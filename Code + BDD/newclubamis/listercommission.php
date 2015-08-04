<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister les commissions</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Lister les commissions</h3>
<form action="listercommission.php" method="POST">
<br>
</form>
</center>
<?php

connexion();
$sql1="select * from commission 
where nom_com!='Aucune' 
order by datecreation_commission";
$resultat=mysql_query($sql1) or die('erreur dans la requete');
echo "<center> <b>Il y a ".mysql_num_rows($resultat)." Commission(s)</b></center>";
?>
<center>
<div class="tableau">
	<table>
<tr ><td>Nom commission</td><td>Date création commission</td><td>Date fin commission</td><td>Gestion de la commission</td></tr>
<?php

while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
<tr><td><?php echo $enreg['nom_com']; ?></td>
<td><?php echo $enreg['datecreation_commission']; ?></td>
<td><?php echo $enreg['datefin_commission']; ?></td>
<td><center><a href="listeramiinscritcommission.php?reference=<?php echo $enreg['id_com'];?>">Lister les amis affectés sur cette commission</a><center>
<center><a href="inscriptionamicommission.php?reference2=<?php echo $enreg['id_com'];?>">Affecter un ami sur cette commission</a><center>
<center><a href="supprimercommission.php?reference3=<?php echo $enreg['id_com'];?>">Supprimer cette commission</a><center></td>
</tr>
<?php
} // fin de while
echo "</table>";
deconnexion();
?>
</div>
</body>
</html>
