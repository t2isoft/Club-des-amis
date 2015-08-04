<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Ajouter un dîner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
            .UpperCase{
                    text-transform: uppercase
            }
</style>
</head>
<body>

<center>
<h3>Ajouter un nouveau dîner</h3>
<div class="formulaire">
	<form action="ajouterdiner.php" method="POST">
	<table >
	<tr><th>Date du dîner<td><input type="date" name="date_diner"></td></tr>
	<tr><th>Lieu du dîner</th><td><input type="text" class="UpperCase" name="lieu_diner"></td></tr>
	<tr><th>Prix du dîner<td><input type="number"/ name="prix_diner"></td></tr>
	</table>
	<br>
	<input type="submit" value="Ajouter" class="buttonform"> &nbsp;&nbsp;<input type="reset" value="Effacer" class="buttonform">
	</form>
	</center>
</div>

<?php

if(isset($_POST['date_diner']) and isset($_POST['lieu_diner']) and isset($_POST['prix_diner']))
{

if(!empty($_POST['date_diner']) or !empty($_POST['lieu_diner']) or !empty($_POST['prix_diner']))
	{
	connexion();
	
	$d2=date("Y-m-d");
		
		if($_POST['date_diner']>=$d2)
		{
		$sql1="select * from diner where date_diner='".$_POST['date_diner']."'
		and lieu_diner='".$_POST['lieu_diner']."'
		and prix_diner='".$_POST['prix_diner']."'";
		$resultat=mysql_query($sql1) or die('erreur exec recet');
		
		if(mysql_num_rows($resultat)==0)
			{
			$lieudiner=strtoupper($_POST['lieu_diner']);
			$sql2="insert into diner 
			values('','".$_POST['date_diner']."','".$lieudiner."','".$_POST['prix_diner']."')";
			mysql_query($sql2);
			echo "<script>alert(\"Le dîner est ajouté avec succés \");
			document.location.href = 'menutresorier.php';</script>";
			deconnexion();
			}

		
		else
		alerte('Ce diner a déjà été enregistré');
		}

	else
	echo "<script>alert(\"La date du diner ne peut être antérieure à la date du jour \");
	document.location.href = 'menutresorier.php';</script>";
	}

else
alerte('Remplir les champs');
}

else
//alerte('Les variables non existants');
?>
</body>
</html>