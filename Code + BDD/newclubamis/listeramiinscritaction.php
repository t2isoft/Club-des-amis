<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister les amis inscrits à une action</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Lister les amis inscrits à une action</h3>
<form action="listeramiinscritaction.php" method="POST">
<table>
<tr><th>Choisissez l'action</th><td>
<select name="nom_action"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_action, nom_action FROM action"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_action']."'>".$liste_val['nom_action']."</option>\n"; 
} 
?>
</select> 
</table>
<br>
<input type="submit" value="Rechercher"> &nbsp;&nbsp;<input type="reset" value="Annuler">
</form>
</center>
<?php

if(isset($_POST['nom_action'])){

$sql1="select * from amis, action, participer where 
amis.id_amis=participer.id_amis
and action.id_action=participer.id_action
and nom_action='".$_POST['nom_action']."'"; 
$resultat1=mysql_query($sql1) or die('erreur1');
//$resa=mysql_fetch_array($resultat1);

if(mysql_num_rows($resultat1)!=0)

{
echo "<center> <b>Il y a ".mysql_num_rows($resultat1)." ami(s) inscrit(s) à cette action</b></center>";
?>
<br>
<div class="tableau">
<center><table>
<tr><td>Nom Amis</td><td>Prénom Amis</td><td>Don Amis</td><td>Désinscrire l'ami de l'action</td></tr>
<?php

while($resa=mysql_fetch_array($resultat1))
{
?>
<tr><td><?php echo $resa['nom_amis']; ?></td>
<td><?php echo $resa['prenom_amis']; ?></td>
<td><?php echo $resa['don_amis']; ?></td>
<td><a href="supprimeramiinscritaction.php?reference=<?php echo $resa['id_amis'];?>&reference2=<?php echo $resa['id_action'];?>">Désinscription</a></td>
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
echo "<script>alert(\"Aucun ami inscrit à cette action\");
document.location.href='listeramiinscritaction.php';</script>";
}
}
else
{
//echo "<script>alert(\"Selectionnez une action\");
//document.location.href='listeramiinscritaction.php';</script>";
}

?>
</body>
</html>