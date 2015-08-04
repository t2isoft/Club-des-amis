<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression d'action</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();

$d2 = date("Y-m-d");
$sql1="select * from action
where id_action='".$_GET['reference']."'
and date_debut>='".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

if(mysql_num_rows($resultat)==0)
{
echo "<script>alert(\"L'action est déjà commencée et ne peut donc être supprimée \");
document.location.href = 'listeraction.php';</script>";
}
else
{
$sql="delete from action where id_action='".$_GET['reference']."'";
mysql_query($sql) or die('Suppression impossible car des personnes sont inscrites à cette action');
echo "<script>alert(\"L'action a été supprimée avec succés \");
document.location.href = 'listeraction.php';</script>";
}
?>
</center>
</body>
</html>
