<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister amis inscrits commission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();
$sql1="select * from commission, amis, fonctioncommission, fonctioncommissionami where 
amis.id_amis=fonctioncommissionami.id_amis
and commission.id_com=fonctioncommissionami.id_com
and fonctioncommission.id_fonctioncommission=fonctioncommissionami.id_fonctioncommission
and fonctioncommissionami.id_com='".$_GET['reference']."'
order by fonctioncommission.id_fonctioncommission";
$resultat1=mysql_query($sql1) or die('erreur lecture: '. $sql1. ' '. mysql_error());
if(mysql_num_rows($resultat1)!=0)
{
echo "<center> <b>Il y a ".mysql_num_rows($resultat1)." ami(s) affectés(s) sur cette commission</b></center>";
?>
<br>
<div class="tableau">
<center><table>
<tr><td>Nom Amis</td><td>Prénom Amis</td><td>Fonction commission</td><td>Désinscrire l'ami de la commission</td></tr>
<?php

	while($resa=mysql_fetch_array($resultat1))
	{
	?>
	<tr><td><?php echo $resa['nom_amis']; ?></td>
	<td><?php echo $resa['prenom_amis']; ?></td>
	<td><?php echo $resa['nom_fonctioncommission']; ?></td>
	<td><a href="supprimeramiinscritcommission.php?reference=<?php echo $resa['id_amis'];?>&reference2=<?php echo $resa['id_com'];?>">Désinscription</a></td>
	</tr>
	<?php

	}	
?>
</table>
</div>
<?php
}
else
{
echo "<script>alert(\"Aucun ami affecté sur cette commission\");
document.location.href='listercommission.php';</script>";
}

?>
</center>
</body>
</html>