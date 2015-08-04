<?php 
include('menutresorier.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Inscription d'un ami à un dîner</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<center>
<h3>Inscription d'un ami à un dîner</h3>
<div class="formulaire">
<form action="inscriptionamidiner.php" method="POST">
<table>
<tr><th>Choisissez l'ami à inscrire</th><td>
<select name="nom_amis"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis FROM amis where date_sortie='0000-00-00'"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']."</option>\n"; 
} 
?> 
<tr><th>Choisissez le dîner</th><td>
<select name="lieu_diner"> 
<?php 
connexion();

$d2 = date("Y-m-d");
$liste_req = mysql_query("SELECT id_diner, lieu_diner FROM diner WHERE date_diner>='".$d2."'"); 
while ($liste_val = mysql_fetch_array($liste_req))
{ 
    echo "<option value='".$liste_val['lieu_diner']."'>".$liste_val['lieu_diner']."</option>\n"; 
} 
?> 
<tr><th>Nombre d'invités</th><td><input type="number"/ name="nb_invite"></td></tr>
</select> 
</table>
<br>
<input type="submit" value="Ajouter"> &nbsp;&nbsp;<input type="reset" value="Effacer">
</form>
</center>
<?php
if(isset($_POST['nom_amis']) and isset($_POST['lieu_diner']))
{
if(!empty($_POST['nom_amis']) and !empty($_POST['lieu_diner']))
{
connexion();
// Récupération id_amis
$sql1="select id_amis from amis where nom_amis='".$_POST['nom_amis']."'"; 
$resultat1=mysql_query($sql1) or die('erreur exec recet');
$sql3=mysql_fetch_array($resultat1);

// Récupération id_diner/
$sqla="select id_diner from diner where lieu_diner='".$_POST['lieu_diner']."'"; 
$resultata=mysql_query($sqla) or die('erreur exec recet');
$resa=mysql_fetch_array($resultata);

// Vérification d'existance d'ami sur diner
$sqlv="select id_amis from manger where id_amis='".$sql3[0]."' and id_diner='".$resa[0]."'"; 
$req = mysql_query($sqlv);
$resultatv=mysql_query($sqlv) or die('erreur exec recet');
if(mysql_num_rows($resultatv)==0)
{
// Insertion de l'ami sur le diner
$insert="insert into manger 
values('".$_POST['nb_invite']."','".$sql3[0]."','".$resa[0]."')";
mysql_query($insert) or die('erreur insertion: '. $insert. ' '. mysql_error());

//recuperation prix_diner
$prix_diner="select prix_diner from diner where id_diner='".$resa[0]."'";
$resultat60=mysql_query($prix_diner) or die('erreur exec recet3');
	$sql61=mysql_fetch_array($resultat60);

//recupération annee en cours
list($a,$m,$j)=explode("-",$d2);
$annee="$a";

//recuperation id_relever
$id_relever="select id_releve from releve where id_amis='".$sql3[0]."'
and annee_montant='".$annee."'";
$resultat70=mysql_query($id_relever) or die('erreur exec ');
$sql71=mysql_fetch_array($resultat70);
	
	
//recupereation montant_releve
$montant_releve="select montant_releve from releve where id_amis='".$sql3[0]."' and annee_montant='".$annee."'";
$resultat50=mysql_query($montant_releve) or die('erreur lecture: '. $montant_releve. ' '. mysql_error());
$sql51=mysql_fetch_array($resultat50);


//calcul nouveau montant releve
$nb_invite=$_POST['nb_invite'];

$new_montant_relever=$sql51['montant_releve'] + (1+ $_POST['nb_invite']) * $sql61['prix_diner'];



//mise a jour du montant relever
$sql80="update releve set montant_releve='".$new_montant_relever."' where id_releve='".$sql71['id_releve']."'";
mysql_query($sql80) or die('erreur de mise a jour');





deconnexion();

echo "<script>alert(\"Ami inscrit avec succés\");
document.location.href='menutresorier.php';</script>";
/*header("Location:menutresorier.php");*/
}
else

echo "<script>alert(\"L'ami existe déjà sur ce diner\");
document.location.href='inscriptionamidiner.php';</script>";
}

else

alerte('Les champs sont vides');
}


else

//alerte('Les variables non existants');



?>
</div>
</body>
</html>