<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression d'un ami inscrit à une action</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();
$d2 = date("Y-m-d");
$sql1="select * from action
where id_action='".$_GET['reference2']."'
and date_fin<'".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

if(mysql_num_rows($resultat)!=0)
{
echo "<script>alert(\"L'action est terminée; la désinscription est donc impossible \");
document.location.href = 'menusecretaire.php';</script>";
}
else

	// Récupération don amis
	$sql60="select don_amis from participer 
	where id_action='".$_GET['reference2']."'";
	$resultat60=mysql_query($sql60) or die('erreur exec recet3');
	$sql61=mysql_fetch_array($resultat60);
	
	// Récupération fonds collectés action
	$sql62="select fonds_col from action 
	where id_action='".$_GET['reference2']."'";
	$resultat62=mysql_query($sql62) or die('erreur exec recet3');
	$sql63=mysql_fetch_array($resultat62);
	
	// Calcul nouveau montant fonds collectés
	$sql70=$sql63['fonds_col'] - $sql61['don_amis'];  
	
	//Mise à jour du nouveau montant fonds collectés de l'action
	$sql5=" update action set fonds_col='".$sql70."' where id_action='".$_GET['reference2']."'";
	mysql_query($sql5) or die('erreur exec recet7');
	
	//Désinscription de l'ami
	$sql="delete from participer where id_amis='".$_GET['reference']."'
	and id_action='".$_GET['reference2']."'";
	mysql_query($sql) or die('Erreur de suppression');
	echo "<script>alert(\"L'ami a été supprimé de cette action avec succés \");
	document.location.href = 'menusecretaire.php';</script>";
?>
</center>
</body>
</html>

