<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Modifier une action</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
            .UpperCase{
                    text-transform: uppercase
            }
</style>
</head>
<body>
<?php
if(isset($_GET['reference']))
{
connexion();
$d2 = date("Y-m-d");
$sql10="select * from action
where id_action='".$_GET['reference']."'
and date_fin>='".$d2."'";
$resultat10=mysql_query($sql10) or die('erreur dans le requete');

if(mysql_num_rows($resultat10)!=0)
{
$sql1="select * from action, amis, commission 
where action.id_amis=amis.id_amis
and action.id_com=commission.id_com
and id_action='".$_GET['reference']."'";
$r1=mysql_query($sql1);
while($enreg=mysql_fetch_array($r1))
{
?>
<div class="tableau">
<center>
<h3>Modification de l'action</h3>
<form action="modifieraction.php" method="post">
<table >
<tr><td bgcolor="#C6C1B0">Nom Action</td><td><input type="text" class="UpperCase" name="nom_action" 
value="<?php echo $enreg['nom_action']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Date de début</td><td><input type="date" 
name="date_debut" value="<?php echo $enreg['date_debut']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Date de fin</td><td><input type="date" name="date_fin" 
value="<?php echo $enreg['date_fin']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Commission pilote</td>
	<td><select name="id_com"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT * FROM commission where 
(datecreation_commission<='".$d2."'
and datefin_commission>'".$d2."')
or datecreation_commission is null"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option ";
	if($liste_val['id_com']==$enreg['id_com']){ echo "selected";}
	echo " value='".$liste_val['id_com']."'>".$liste_val['nom_com']."</option>\n"; 
} 
?> 
	</select> </td>
<tr>
<tr><td bgcolor="#C6C1B0">Responsable</td>
	<td><select name="responsable"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis FROM amis where date_sortie='0000-00-00'"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option ";
	if($liste_val['id_amis']==$enreg['id_amis']){ echo "selected";}
	echo " value='".$liste_val['id_amis']."'>".$liste_val['nom_amis']."</option>\n"; 
} 
?> 
	</select> </td>
<tr>
</table>
<input type="submit" value="Modifier"> &nbsp;&nbsp;<input type="reset" value="Annuler">
<input type="hidden" name="reference" value="<?php echo $_GET['reference']; ?>">
</form>
</center>
<?php
deconnexion();
}
}
else
echo "<script>alert(\"L'action est terminée et ne peut donc être modifiée \");
document.location.href = 'menusecretaire.php';</script>";


}
// mise à jour de l'action
if(isset($_POST['nom_action']) and isset($_POST['date_debut']) and isset($_POST['date_fin']) and isset($_POST['id_com'])and isset($_POST['responsable']))
{
	connexion();
	$d2=date("Y-m-d");
	if($_POST['date_debut']>=$d2)
	{
		if($_POST['date_debut']<=$_POST['date_fin'])
		{
		$nomaction=strtoupper($_POST['nom_action']);
		$sql="update action set nom_action='".$nomaction."', date_debut='".$_POST['date_debut']."',  date_fin='".$_POST['date_fin']."', id_com='".$_POST['id_com']."', id_amis='".$_POST['responsable']."' where id_action= '".$_POST['reference']."'";
		mysql_query($sql) or die(mysql_error());
		alerte('La modification a été faite avec succés');
		}
		else
		{
		echo "<script>alert(\"La date de fin ne peut-être antérieure à la date de début \");
		document.location.href = 'listeraction.php';</script>";

		}
	}
	else
	{
	echo "<script>alert(\"La date de début de l\'action ne peut être antérieure à la date d'aujourd'hui \");
		document.location.href = 'listeraction.php';</script>";

	}
    
}
?>
</div>
</body>
</html>