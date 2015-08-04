<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Voir les releves par année</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Voir les releves par année</h3>
<div class="formulaire">
<form action="editionreleveannee.php" method="POST">
<table>
<tr><th>Choisissez l'année</th><td>
<select name="annee_montant"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT distinct annee_montant FROM releve order by annee_montant"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['annee_montant']."'>".$liste_val['annee_montant']."</option>\n"; 
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



if(isset($_POST['annee_montant'])){


$sql1="SELECT * 
FROM amis, releve
WHERE amis.id_amis = releve.id_amis
AND releve.annee_montant ='".$_POST['annee_montant']."'
order by amis.nom_amis";

$resultat1=mysql_query($sql1) or die('erreur lecture: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat1)." relevé(s) pour cette année</b></center>";
?>
<center><table border="1">
<tr 
bgcolor="8a8a8a"><th>Nom de l'ami</th><th>Prénom de l'ami</th><th>Montant de la relève</th></tr>
<?php
while($enreg=mysql_fetch_array($resultat1))
{//debut de while
?>
<tr><td><?php echo $enreg['nom_amis']?></td>
<td><?php echo $enreg['prenom_amis']?></td>
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
