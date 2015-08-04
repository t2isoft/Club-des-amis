<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Inscription d'un ami à une commission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<h3>Inscription d'un ami à une commission</h3>
<div class="formulaire">
<form action="inscriptionamicommission.php" method="POST">
<table >
<tr><th>Choisissez l'ami à inscrire</th><td>
<select name="nom_amis"> 
<?php 
connexion();
$d2 = date("Y-m-d");
$liste_req = mysql_query("SELECT * FROM amis
where id_amis NOT IN (SELECT id_amis FROM fonctioncommissionami,commission
					  Where fonctioncommissionami.id_com=commission.id_com
                      And datecreation_commission<'".$d2."'
                      and datefin_commission>'".$d2."')"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." ".$liste_val['prenom_amis']."</option>\n"; 
} 
?> 
<tr><th>Choisissez la commission</th><td>
<select name="nom_com"> 
<?php 
connexion();


$liste_req = mysql_query("SELECT * FROM commission
						where datecreation_commission<'".$d2."'
						and datefin_commission>'".$d2."'
						and (
							id_com NOT IN (SELECT id_com FROM fonctioncommissionami
											where id_fonctioncommission='1'
											)
							or id_com NOT IN (SELECT id_com FROM fonctioncommissionami
											where id_fonctioncommission='2'
											)
							or id_com NOT IN (SELECT id_com FROM fonctioncommissionami
											where id_fonctioncommission='3'
											)
							)
						
						");
						

while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_com']."'>".$liste_val['nom_com']."</option>\n"; 
} 
?> 
<tr><th>Choisissez la fonction de l'ami</th><td>
<select name="nom_fonctioncommission"> 
<?php 
connexion();
$liste_req = mysql_query("SELECT nom_fonctioncommission FROM fonctioncommission");
																		
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_fonctioncommission']."'>".$liste_val['nom_fonctioncommission']."</option>\n"; 
} 
?> 
</select> 
</table>
<br>
<input type="submit" value="Ajouter"> &nbsp;&nbsp;<input type="reset" value="Effacer">
</form>
</center>
<?php
if(isset($_POST['nom_amis']) and isset($_POST['nom_com']) and isset($_POST['nom_fonctioncommission']))
{
if(!empty($_POST['nom_amis']) and !empty($_POST['nom_com'])and !empty($_POST['nom_fonctioncommission']))
{
connexion();

// Récupération id_amis
$sql1="select id_amis from amis where nom_amis='".$_POST['nom_amis']."'"; 
$resultat1=mysql_query($sql1) or die('erreur exec recet');
$sql3=mysql_fetch_array($resultat1);

// Récupération id_com
$sqla="select id_com from commission where nom_com='".$_POST['nom_com']."'"; 
$resultata=mysql_query($sqla) or die('erreur exec recet2');
$resa=mysql_fetch_array($resultata);

// Récupération id_fonctioncommission
$sqla2="select id_fonctioncommission from fonctioncommission where nom_fonctioncommission='".$_POST['nom_fonctioncommission']."'"; 
$resultata2=mysql_query($sqla2) or die('erreur exec recet3');
$resa2=mysql_fetch_array($resultata2);

// Vérification d'existance de fonction sur commission
$sqlv="select* from fonctioncommissionami where id_com='".$resa[0]."' and id_fonctioncommission='".$resa2[0]."'"; 
$req = mysql_query($sqlv);
$resultatv=mysql_query($sqlv) or die('erreur exec recet');
if(mysql_num_rows($resultatv)==0)
{
// Insertion de l'ami et de l'action
$insert="insert into fonctioncommissionami 
values('".$sql3[0]."','".$resa2[0]."','".$resa[0]."')";
mysql_query($insert) or die('erreur insertion: '. $insert. ' '. mysql_error());

deconnexion();

echo "<script>alert(\"L'ami est désormais affecté sur cette commission\");
document.location.href='menusecretaire.php';</script>";
/*header("Location:menusecretaire.php");*/
}
else

echo "<script>alert(\"Cette fonction est déjà occupée au sein de cette commission\");
document.location.href='inscriptionamicommission.php';</script>";
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