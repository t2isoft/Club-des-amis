<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Créer une action</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
            .UpperCase{
                    text-transform: uppercase
            }
</style>
</head>
<body>
<center>
<h3>Créer une nouvelle action</h3>
<div class="formulaire">
	<form action="ajouteraction.php" method="POST">
	<table >
	<tr><th>Nom action</th><td><input type="text" class="UpperCase" name="nom_action"></td></tr>
	<tr><th>Date de début</th><td><input type="date" name="date_debut"></td></tr>
	<tr><th>Date de fin</th><td><input type="date" name="date_fin"></td></tr>
	<tr><th>Commission pilote de l'action</th><td>
	<select name="id_com"> 
<?php 
connexion();
$d2=date("Y-m-d");
$liste_req = mysql_query("SELECT * FROM commission where 
(datecreation_commission<='".$d2."'
and datefin_commission>'".$d2."')
or datecreation_commission is null"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_com']."'>".$liste_val['nom_com']."</option>\n"; 
} 
?> 
	</select> 
	<tr><th>Responsable de l'action</th><td>
	<select name="id_amis"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis, prenom_amis FROM amis where date_sortie='0000-00-00'"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." ".$liste_val['prenom_amis']."</option>\n"; 
} 
?> 
	</select> 
	</table>
	<br>
	<input type="submit" value="Ajouter" class="buttonform"> &nbsp;&nbsp;<input type="reset" value="Effacer" class="buttonform">
	</form>
	</center>
</div>
<?php 

if(isset($_POST['nom_action']) and isset($_POST['date_debut']) and isset($_POST['date_fin']) and isset($_POST['id_com']) and isset($_POST['id_amis']))
{
if(!empty($_POST['nom_action']) and !empty($_POST['date_debut']) and !empty($_POST['date_fin']) and !empty($_POST['id_com']) and !empty($_POST['id_amis']))
{
connexion();

if($_POST['date_debut']>=$d2)
{
if($_POST['date_debut']<=$_POST['date_fin'])
{
$sql1="select * from action where nom_action='".$_POST['nom_action']."'"; 
$resultat=mysql_query($sql1) or die('erreur exec recet');
if(mysql_num_rows($resultat)==0)
{
$resResponsable="Select id_amis from amis where nom_amis = '".$_POST['id_amis']."'";
$resp=mysql_query($resResponsable) or die('erreur exec recet');
$data = mysql_fetch_array($resp);
$r=$data['id_amis'];

$resCommission="Select id_com from commission where nom_com = '".$_POST['id_com']."'";
$resc=mysql_query($resCommission) or die('erreur exec recet2');
$data2 = mysql_fetch_array($resc);
$r2=$data2['id_com'];

$nomaction=strtoupper($_POST['nom_action']);
$sql2="insert into action
values('','".$nomaction."','".$_POST['date_debut']."','".$_POST['date_fin']."','0','$r2','$r')";
mysql_query($sql2) or die('erreur exec recet');
echo "<script>alert(\"L'action est ajoutée avec succés \");
document.location.href = 'menusecretaire.php';</script>";
}
else
alerte('Action déjà existante');
}
else
alerte('La date de fin ne peut-être antérieure à la date de début');
}
else
echo "<script>alert(\"La date de début de l\'action ne peut être antérieure à la date du jour \");
document.location.href = 'ajouteraction.php';</script>";
}
else
alerte('Les champs sont vides');
}
//else
//alerte('Les variables non existants');

?>
</body>
</html>
