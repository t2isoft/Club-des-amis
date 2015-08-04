<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Amis référencés sur la commission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();
if(isset($enreg['id_com'])){
die(fdsgvfdvd);
$sql1="select * from commission, amis, fonctioncommission, fonctioncommissionami where 
amis.id_amis=fonctioncommissionami.id_amis
and commission.id_com=fonctioncommissionami.id_com
and fonctioncommission.id_fonctioncommission=fonctioncommissionami.id_fonctioncommission
and id_com='".$enreg['id_com']."'"; 
$resultat1=mysql_query($sql1) or die('erreur insertion: '. $sql1. ' '. mysql_error());
//$resa=mysql_fetch_array($resultat1);

if(mysql_num_rows($resultat1)!=0)

{
echo "<center> <b>Il y a ".mysql_num_rows($resultat1)." ami(s) affectés(s) sur cette commission</b></center>";
?>
<br>
<div class="tableau">
<center><table>
<tr><td>Nom Amis</td><td>Prénom Amis</td><td>Fonction commission</td><td>Désinscrire l'ami de l'action</td></tr>
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
document.location.href='listeramiinscritcommission.php';</script>";
}
}
else
{
//echo "<script>alert(\"Selectionnez une action\");
//document.location.href='listeramiinscritcommission.php';</script>";
}

?>
</center>
</body>
</html>