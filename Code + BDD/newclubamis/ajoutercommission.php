<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Créer une commission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
            .UpperCase{
                    text-transform: uppercase
            }
</style>
</head>
<body>
<center>
<h3>Créer une nouvelle commission</h3>
<div class="formulaire">
	<form action="ajoutercommission.php" method="POST">
	<table >
	<tr><th>Nom de la commission</th><td><input type="text" class="UpperCase" name="nom_com"></td></tr>
	</table>
	<br>
	<input type="submit" value="Ajouter" class="buttonform"> &nbsp;&nbsp;<input type="reset" value="Effacer" class="buttonform">
	</form>
	</center>
</div>
<?php 

if(isset($_POST['nom_com']))
{
if(!empty($_POST['nom_com']))
{
connexion();

$sql1="select * from commission where nom_com='".$_POST['nom_com']."'"; 
$resultat=mysql_query($sql1) or die('erreur exec recet');
if(mysql_num_rows($resultat)==0)
{
$d2=date("Y-m-d");


$sql50="select datefin_bureau from bureau 
	where datefin_bureau>='".$d2."'"; 
	$resultat50=mysql_query($sql50) or die('erreur lecture: '. $sql50. ' '. mysql_error());
	$sql51=mysql_fetch_array($resultat50);

$nomcom=strtoupper($_POST['nom_com']);
$sql2="insert into commission
values('','".$nomcom."','$d2','".$sql51['datefin_bureau']."')";
mysql_query($sql2) or die('erreur exec recet');
echo "<script>alert(\"La commission est ajoutée avec succés \");
document.location.href = 'menusecretaire.php';</script>";
}
else
alerte('Une commission portant ce nom existe déjà');
}
else
alerte('Les champs sont vides');
}
//else
//alerte('Les variables non existants');

?>
</body>
</html>
