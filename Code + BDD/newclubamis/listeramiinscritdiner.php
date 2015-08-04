<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Lister les amis inscrits à un dîner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Lister les amis inscrits à un dîner</h3>
<form action="listeramiinscritdiner.php" method="POST">
<table >
<tr><th>Choisissez le dîner</th><td>
<select name="lieu_diner"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_diner, lieu_diner FROM diner"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['lieu_diner']."'>".$liste_val['lieu_diner']."</option>\n"; 
} 
?>
</select> 
</table>
<br>
<input type="submit" value="Rechercher"> &nbsp;&nbsp;<input type="reset" value="Annuler">
</form>
</center>
<?php

if(isset($_POST['lieu_diner'])){

$sql1="select * from amis, diner, manger where 
amis.id_amis=manger.id_amis
and diner.id_diner=manger.id_diner
and lieu_diner='".$_POST['lieu_diner']."'"; 
$resultat1=mysql_query($sql1) or die('erreur1');
//$resa=mysql_fetch_array($resultat1);

if(mysql_num_rows($resultat1)!=0)

{
echo "<center> <b>Il y a ".mysql_num_rows($resultat1)." ami(s) inscrit(s) à ce dîner</b></center>";
?>
<br>
<div class="tableau">
<center><table >
<tr><td>Nom Amis</td><td>Prenom Amis</td><td>Nombres Invités</td><td>Supprimer</td></tr>
<?php

while($resa=mysql_fetch_array($resultat1))
{
?>
<tr><td><?php echo $resa['nom_amis']; ?></td>
<td><?php echo $resa['prenom_amis']; ?></td>
<td><?php echo $resa['nb_invites']; ?></td>
<td><a href="supprimeramiinscritdiner.php?reference=<?php echo $resa['id_amis'];?>&reference2=<?php echo $resa['id_diner'];?>">Désinscription</a></td>
</tr>
<?php

}
?>
</table></div>
<?php
}
else
{
echo "<script>alert(\"Aucun ami inscrit à ce diner\");
document.location.href='listeramiinscritdiner.php';</script>";
}
}
else
{
//echo "<script>alert(\"Selectionnez un diner\");
//document.location.href='listeramiinscritdiner.php';</script>";
}

?>

</body>
</html>