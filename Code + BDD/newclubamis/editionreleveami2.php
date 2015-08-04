<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Chercher un ami</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<center>
<h3>Rechercher relevé par ami</h3>
<form action="editionreleveami.php" method="POST">
<table>
<tr><th>Choisissez l'ami</th><td>
<select name="mc"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis FROM amis"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']."</option>\n"; 
} 
?> 
 
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
$sql1="select * from amis, releve where releve.id_releve=amis.id_amis and nom_amis='".$_POST['mc']."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

?>
<center><table border="1">
<tr 
bgcolor="#8a8a8a"><td>Nom Amis</td><th>Prénom Amis</td><td>Montant</td><td>Année</td>
<?php
if($enreg=mysql_fetch_array($resultat))

{//debut de while
?>
<tr><td><?php echo $enreg['nom_amis']; ?></td>
<td><?php echo $enreg['prenom_amis']; ?></td>
<td><?php echo $enreg['montant_releve']; ?></td>
<td><?php echo $enreg['annee_montant']; ?></td>

</tr>
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