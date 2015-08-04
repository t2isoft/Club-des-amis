<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Voir les releve par ami</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Voir les releve par ami</h3>
<form method="POST" action="" >
<tr><th>Choisissez l'ami</th><td>
<input type="text" name="search" id="search">
</form>
<?php 
connexion();

$liste_req = mysql_query("SELECT * FROM amis"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." </option>\n"; 
} 
?>
</select> 
</table>
<br>
</form>
</center>
<?php
connexion();



if(isset($_POST['nom_amis'])){

// Récupération id_visiteur
$sql3="select id_amis from amis where nom_amis='".$_POST['nom_amis']."'"; 
$resultat3=mysql_query($sql3) or die('erreur lecture: '. $sql3. ' '. mysql_error());
$sql4=mysql_fetch_array($resultat3);

$sql1="select * from amis, releve 
where releve.id_releve=amis.id_amis 
and amis.id_amis='".$sql4['id_amis']."'";


$resultat1=mysql_query($sql1) or die('erreur lecture: '. $sql1. ' '. mysql_error());


echo "<center> <b>".mysql_num_rows($resultat1)." Releve pour cet ami</b></center>";
?>
<center><table border="1">
<tr 
bgcolor="#8a8a8a"><td>Nom Amis</td><th>Prénom Amis</td><td>Montant</td><td>Année</td>
<?php
while($resa=mysql_fetch_array($resultat1))
{//debut de while
?>
<tr><td><?php echo $enreg['nom_amis']; ?></td>
<td><?php echo $enreg['prenom_amis']; ?></td>
<td><?php echo $enreg['montant_releve']; ?></td>
<td><?php echo $enreg['annee_montant']; ?></td>

</tr>
<?php
} // fin de while

?>
</table>
</center>
<?php
}
?>
</body>
</html>

