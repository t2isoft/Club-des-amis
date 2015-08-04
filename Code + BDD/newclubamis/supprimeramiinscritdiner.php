<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression d'un ami inscrit à un dîner</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();
$d2 = date("Y-m-d");
$sql1="select * from diner
where id_diner='".$_GET['reference2']."'
and date_diner<'".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');


if(mysql_num_rows($resultat)!=0)
{
echo "<script>alert(\"Le diner est terminée; la désinscription est donc impossible \");
document.location.href = 'menutresorier.php';</script>";
}
else

	// Récupération id_amis
	$recuperation_id="select id_amis from amis where id_amis='".$_GET['reference']."'"; 
	$resultat_id=mysql_query($recuperation_id) or die('erreur recuperation id');
	$sql_id_amis=mysql_fetch_array($resultat_id);
	
	// Récupération prix diner
	$recuperation_prix_diner="select prix_diner from diner 
	where id_diner='".$_GET['reference2']."'";
	$resultat_prix_diner=mysql_query($recuperation_prix_diner) or die('erreur exec recet3');
	$sql_prix_diner=mysql_fetch_array($resultat_prix_diner);
	
	// Récupération nb_invite
	$recuperation_nb_invite="select nb_invites from manger where id_diner='".$_GET['reference2']."' ";
	$resultat_nb_invite=mysql_query($recuperation_nb_invite) or die('erreur exec recet7');
	$sql_nb_invite=mysql_fetch_array($resultat_nb_invite);
	
	//recupération annee en cours
	list($a,$m,$j)=explode("-",$d2);
	$annee="$a";

	//recupereation montant_releve
	$montant_releve="select montant_releve from releve where id_amis='".$_GET['reference']."'
	and annee_montant='".$annee."'";
	$resultat50=mysql_query($montant_releve) or die('erreur lecture: '. $montant_releve. ' '. mysql_error());
	$sql51=mysql_fetch_array($resultat50);



	//calcul nouveau montant releve

	$new_montant_relever=$sql51['montant_releve'] - (  1 + $sql_nb_invite['nb_invites']) * $sql_prix_diner['prix_diner'];


	//recuperation id_relever
	$id_relever="select id_releve from releve where id_amis='".$_GET['reference']."'
	and annee_montant='".$annee."'";
	$resultat70=mysql_query($id_relever) or die('erreur exec ');
	$sql71=mysql_fetch_array($resultat70);



	//mise a jour du montant relever
	$sql80="update releve set montant_releve='".$new_montant_relever."' where id_releve='".$sql71['id_releve']."'";
	mysql_query($sql80) or die('erreur de mise a jour');

	//Désinscription de l'ami
	$sql="delete from manger where id_amis='".$_GET['reference']."'
	and id_diner='".$_GET['reference2']."'";
	mysql_query($sql) or die('Erreur de suppression');
	echo "<script>alert(\"L'ami a été supprimé du diner avec succés \");
	document.location.href = 'menutresorier.php';</script>";

?>
</center>
</body>
</html>

