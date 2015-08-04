<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression d'un ami inscrit à une commission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();
$d2 = date("Y-m-d");
$sql1="select * from commission 
where id_com='".$_GET['reference2']."'
and datefin_commission<'".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

if(mysql_num_rows($resultat)!=0)
{
echo "<script>alert(\"La commission est terminée; la désinscription est donc impossible \");
document.location.href = 'listercommission.php';</script>";
}
else


	
	//Désinscription de l'ami
	$sql="delete from fonctioncommissionami where id_amis='".$_GET['reference']."'
	and id_com='".$_GET['reference2']."'";
	mysql_query($sql) or die('Erreur de suppression');
	echo "<script>alert(\"L'ami a été supprimé de cette commission avec succés \");
	document.location.href = 'listercommission.php';</script>";
?>
</center>
</body>
</html>

