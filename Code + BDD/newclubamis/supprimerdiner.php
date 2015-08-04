<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression de dîner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();

$d2 = date("Y-m-d");
$sql1="select * from diner
where id_diner='".$_GET['reference']."'
and date_diner>'".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

if(mysql_num_rows($resultat)==0)
{
echo "<script>alert(\"Le dîner a déjà eu lieu et ne peut donc être supprimé \");
document.location.href = 'listerdiner.php';</script>";
}
else
{
$sql="delete from diner where id_diner='".$_GET['reference']."'";
mysql_query($sql) or die('Suppression impossible car des personnes sont inscrites à ce dîner');
echo "<script>alert(\"Le diner a été supprimé avec succés \");
document.location.href = 'listerdiner.php';</script>";
}
?>
</center>
</body>
</html>
