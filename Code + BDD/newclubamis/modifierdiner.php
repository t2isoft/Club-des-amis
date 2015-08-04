<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Modifier un diner</title>
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
$sql10="select * from diner
where id_diner='".$_GET['reference']."'
and date_diner>='".$d2."'";
$resultat10=mysql_query($sql10) or die('erreur dans le requete');

if(mysql_num_rows($resultat10)!=0)
{ 
	$sql1="select * from diner
	where id_diner='".$_GET['reference']."'";
	$r1=mysql_query($sql1) or die('Erreur SQL !'.$r1.'<br>'.mysql_error());;
	while($enreg=mysql_fetch_array($r1))
	{ 
	?>
	<div class="tableau">
	<center>
	<h3>Modification de diner </h3>
	<form action="modifierdiner.php" method="post">
	<table >
	<tr><td bgcolor="#C6C1B0">Lieu du diner</td><td><input type="text" class="UpperCase" name="lieu_diner" 
	value="<?php echo $enreg['lieu_diner']; ?>"></td></tr>
	<tr><td bgcolor="#C6C1B0">Date du diner</td><td><input type="date" 
	name="date_diner" value="<?php echo $enreg['date_diner']; ?>"></td></tr>
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
echo "<script>alert(\"Le diner est terminée et ne peut donc être modifiée \");
document.location.href = 'menutresorier.php';</script>";


}
// mise à jour du diner
if(isset($_POST['lieu_diner']) and isset($_POST['date_diner']))
{
	connexion();
	$d2=date("Y-m-d");
	if($_POST['date_diner']>$d2)
	{
	$lieudiner=strtoupper($_POST['lieu_diner']);
	$sql="update diner set lieu_diner='".$lieudiner."', date_diner='".$_POST['date_diner']."' where id_diner= '".$_POST['reference']."'";
	mysql_query($sql) or die(mysql_error());
	alerte('La modification a été faite avec succés');
	}
	else
	{
	echo "<script>alert(\"La date du diner ne peut être antérieure à la date d'aujourd'hui \");
		document.location.href = 'menutresorier.php';</script>";

	}
    
}

?>
</div>
</body>
</html>