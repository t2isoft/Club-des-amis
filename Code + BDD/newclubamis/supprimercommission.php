<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression de commission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();

$d2 = date("Y-m-d");
$sql1="select * from commission
where id_com='".$_GET['reference3']."'
and datefin_commission>='".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

if(mysql_num_rows($resultat)==0)
{
echo "<script>alert(\"La commission est déjà terminée et ne peut donc être supprimée \");
document.location.href = 'menusecretaire.php';</script>";
}
else
{
$sql="delete from commission where id_com='".$_GET['reference3']."'";
mysql_query($sql) or die('Suppression impossible car des amis sont affectés sur cette commission');
echo "<script>alert(\"La commission a été supprimée avec succés \");
document.location.href = 'menusecretaire.php';</script>";
}
?>
</center>
</body>
</html>
