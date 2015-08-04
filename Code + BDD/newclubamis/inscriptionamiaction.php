<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Inscription d'un ami à une action</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Inscription d'un ami à une action</h3>
<div class="formulaire">
<form action="inscriptionamiaction.php" method="POST">
<table >
<tr><th>Choisissez l'ami à inscrire</th><td>
<select name="nom_amis"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis, prenom_amis FROM amis where date_sortie='0000-00-00'"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." </option>\n"; 
} 
?> 
<tr><th>Choisissez l'action</th><td>
<select name="nom_action"> 
<?php 
connexion();

$d2 = date("Y-m-d");
$liste_req = mysql_query("SELECT id_action, nom_action FROM action WHERE date_fin>='".$d2."'"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_action']."'>".$liste_val['nom_action']."</option>\n"; 
} 
?> 
<tr><th>Don de l'ami</th><td><input type="number"/ name="don_amis"></td></tr>
</select> 
</table>
<br>
<input type="submit" value="Ajouter"> &nbsp;&nbsp;<input type="reset" value="Effacer">
</form>
</center>
<?php
if(isset($_POST['nom_amis']) and isset($_POST['nom_action']) and isset($_POST['don_amis']))
{
if(!empty($_POST['nom_amis']) and !empty($_POST['nom_action'])and !empty($_POST['don_amis']))
{
connexion();
// Récupération id_amis
$sql1="select id_amis from amis where nom_amis='".$_POST['nom_amis']."'"; 
$resultat1=mysql_query($sql1) or die('erreur exec recet');
$sql3=mysql_fetch_array($resultat1);

// Récupération id_action/
$sqla="select id_action from action where nom_action='".$_POST['nom_action']."'"; 
$resultata=mysql_query($sqla) or die('erreur exec recet');
$resa=mysql_fetch_array($resultata);

// Vérification d'existance d'ami sur action
$sqlv="select id_amis from participer where id_amis='".$sql3[0]."' and id_action='".$resa[0]."'"; 
$req = mysql_query($sqlv);
$resultatv=mysql_query($sqlv) or die('erreur exec recet');
if(mysql_num_rows($resultatv)==0)
{
// Insertion de l'ami sur l'action
$insert="insert into participer 
values('".$_POST['don_amis']."','".$sql3[0]."','".$resa[0]."')";
mysql_query($insert) or die('erreur insertion: '. $insert. ' '. mysql_error());

// Récupération fonds collectés sur action/
$sql12="select fonds_col from action where id_action='".$resa[0]."'"; 
$resultat12=mysql_query($sql12) or die('erreur exec recet');
$resa12=mysql_fetch_array($resultat12);

// Calcul nouveau fonds collectés
$sql70=$resa12['fonds_col'] + $_POST['don_amis'];  
	
	
//Mise à jour de l'action
$sql80=" update action set fonds_col='".$sql70."' where id_action='".$resa[0]."'";
mysql_query($sql80) or die('erreur exec recet5');

deconnexion();

echo "<script>alert(\"L'ami est désormais inscrit à cette action\");
document.location.href='menusecretaire.php';</script>";
/*header("Location:menusecretaire.php");*/
}
else

echo "<script>alert(\"L'ami est déja inscrit à cette action\");
document.location.href='inscriptionamiaction.php';</script>";
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