<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Chercher/Modifier/Supprimer un ami</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Chercher/Modifier/Supprimer un ami</h3>
<form action="chercherami.php" method="POST">
<table border="1" bgcolor="#8a8a8a">
<tr><td>Rechercher: </td><td><input type="text" name="mc"></td></tr>
</table>
<br>
<input type="submit" value="Rechercher"> &nbsp;&nbsp;<input type="reset" value="Annuler">
</form>
</center>
<?php
if(isset($_POST['mc'])) // variable existant
{
if(!empty($_POST['mc'])) //champs non vide
{
connexion();
$sql1="select * from amis where date_sortie='0000-00-00'
and (id_amis='".$_POST['mc'].
"' or nom_amis='".$_POST['mc']."' or prenom_amis='".$_POST['mc'].
"' or date_entree='".$_POST['mc']."' or tel_fixe='".$_POST['mc'].
"' or tel_port='".$_POST['mc']."' or email='".$_POST['mc'].
"' or num_adr='".$_POST['mc']."' or rue_adr='".$_POST['mc'].
"' or cp_adr='".$_POST['mc']."' or ville_adr='".$_POST['mc'].
"')";
$resultat=mysql_query($sql1) or die('erreur dans le requete');
echo "<center> <b>Il y a ".mysql_num_rows($resultat)." Ami(s)</b></center>";
?>
<center>
<div class="tableau">
<table>
<tr><td>Nom Amis</td><td>Prénom Amis</td><td>Date Entrée</td><td>Téléphone fixe</td><td>Téléphone portable</td>
<td>Email</td><td>Numéro de la rue</td><td>Nom de la rue</td><td>Code Postal</td><td>Ville</td><td>Parrain 1</td><td>Parrain 2</td>
<td>Modifier / Supprimer</td></tr>
<?php
while($enreg=mysql_fetch_array($resultat))
{//debut de while
?>
<tr><td><?php echo $enreg['nom_amis']; ?></td>
<td><?php echo $enreg['prenom_amis']; ?></td>
<td><?php echo $enreg['date_entree']; ?></td>
<td><?php echo $enreg['tel_fixe']; ?></td>
<td><?php echo $enreg['tel_port']; ?></td>
<td><?php echo $enreg['email']; ?></td>
<td><?php echo $enreg['num_adr']; ?></td>
<td><?php echo $enreg['rue_adr']; ?></td>
<td><?php echo $enreg['cp_adr']; ?></td>
<td><?php echo $enreg['ville_adr']; ?></td>
<td><?php echo $enreg['parrain1']; ?></td>
<td><?php echo $enreg['parrain2']; ?></td>
<td><a href="modifierami.php?reference=<?php echo $enreg['id_amis'];?>">Modifier</a> 
&nbsp;<a href="supprimerami.php?reference=<?php echo $enreg['id_amis'];?>">Supprimer</a></td>
</tr>
</div>
<?php
} // fin de while
echo "</table>";
deconnexion();
} // fin de if de champs vide
else // si le champs mc est vide
alerte('Taper un mot cle');
} //fin de if de variable existants
?>
</body>
</html>