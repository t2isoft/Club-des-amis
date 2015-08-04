<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Voir les releves par ami</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Voir les releves par ami</h3>
<div class="formulaire">
<form action="editionreleveami.php" method="POST">
<table>
<tr><th>Choisissez l'ami</th><td>
<select name="nom_amis"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT * FROM amis"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']."</option>\n"; 
} 
?>
</select> 
</table>
<br>
<input type="submit" value="Rechercher"> &nbsp;&nbsp;<input type="reset" value="Annuler">
</form>
</div>
</center>
<?php
connexion();



if(isset($_POST['nom_amis'])){

// Récupération id_amis
$sql3="select id_amis from amis where nom_amis='".$_POST['nom_amis']."'"; 
$resultat3=mysql_query($sql3) or die('erreur lecture: '. $sql3. ' '. mysql_error());
$sql4=mysql_fetch_array($resultat3);

$sql1="SELECT * 
FROM amis, releve
WHERE amis.id_amis = releve.id_amis
AND amis.id_amis ='".$sql4['id_amis']."'
order by releve.annee_montant";

$resultat1=mysql_query($sql1) or die('erreur lecture: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat1)." relevé(s) pour ce visiteur</b></center>";
?>
<center><table border="1">
<tr 
bgcolor="8a8a8a"><th>Nom de l'amis</th><th>Prénom de l'ami</th><th>Année</th><th>Montant du relevé annuel</th></tr>
<?php
while($enreg=mysql_fetch_array($resultat1))
{//debut de while
?>
<tr><td><?php echo $enreg['nom_amis']?></td>
<td><?php echo $enreg['prenom_amis']?></td>
<td><?php echo $enreg['annee_montant']?></td>
<td><?php echo $enreg['montant_releve']; ?> Euros</td>
</tr>
<?php
} // fin de while

?>
</table>
</center>
</body>
</html>
<?php
}
