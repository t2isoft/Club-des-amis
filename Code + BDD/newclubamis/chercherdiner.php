<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Chercher un dîner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Rechercher un dîner</h3>
<form action="chercherdiner.php" method="POST">
<table>
<tr><td>Mot clé: </td><td><input type="text" name="search" id="search"></td></tr>

</table>
<br>
<input type="submit" value="Rechercher"> &nbsp;&nbsp;<input type="reset" value="Annuler">
</form>
</center>
<?php
if(isset($_POST['search'])) // variable existant
{
if(!empty($_POST['search'])) //champs non vide
{
connexion();
$sql1="select * from diner where id_diner='".$_POST['search'].
"' or date_diner='".$_POST['search']."' or lieu_diner='".$_POST['search'].
"' or prix_diner='".$_POST['search']."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');
echo "<center> <b>Il y a ".mysql_num_rows($resultat)." Dîner(s)</b></center>";
?>
<div class="tableau">
<center><table>
<tr><td>Date du dîner</td><td>Lieu du dîner</td><td>Prix du dîner</td><td>Modifier / Supprimer</td></tr>
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
} // fin de if de champs vide
else // si le champs search est vide
alerte('Taper un mot cle');
} //fin de if de variable existants
?>
</div>
</body>
</html>