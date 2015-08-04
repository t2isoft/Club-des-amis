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
<form action="inscriptionamicommission.php?reference2=<?php echo $_GET['reference2']; ?>" method="POST">
<?php 
connexion();
$d2 = date("Y-m-d");
$sql1="select * from commission
where id_com='".$_GET['reference2']."'
and datefin_commission>='".$d2."'";
$resultat=mysql_query($sql1) or die('erreur dans le requete');

if(mysql_num_rows($resultat)==0)
{
echo "<script>alert(\"La commission est terminée et il est donc impossible d'y affecter un ami \");
document.location.href = 'menusecretaire.php';</script>";
}
else
{
?>
<table>
<tr><th>Choisissez l'ami à inscrire</th><td>
<select name="nom_amis"> 
<?php 
connexion();
$liste_req = mysql_query("SELECT * FROM amis
where date_sortie='0000-00-00'
and id_amis NOT IN (SELECT id_amis FROM fonctioncommissionami,commission
					  Where fonctioncommissionami.id_com=commission.id_com
                      And datecreation_commission<'".$d2."'
                      and datefin_commission>'".$d2."')"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." ".$liste_val['prenom_amis']."</option>\n"; 
} 
?> 
<tr><th>Choisissez la fonction de l'ami</th><td>
<select name="nom_fonctioncommission"> 
<?php 
connexion();
$liste_req = mysql_query("SELECT nom_fonctioncommission
FROM fonctioncommission
WHERE fonctioncommission.id_fonctioncommission NOT 
IN (

SELECT fonctioncommissionami.id_fonctioncommission
FROM fonctioncommissionami, fonctioncommission, commission
WHERE fonctioncommissionami.id_fonctioncommission = fonctioncommission.id_fonctioncommission
AND commission.id_com = fonctioncommissionami.id_com
AND commission.id_com ='".$_GET['reference2']."')"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_fonctioncommission']."'>".$liste_val['nom_fonctioncommission']."</option>\n"; 
}
} 
?> 
</select> 
</table>
<br>
<input type="submit" value="Ajouter"> &nbsp;&nbsp;<input type="reset" value="Effacer">
</form>
</center>
<?php
if(isset($_POST['nom_amis']) and isset($_POST['nom_fonctioncommission']))
{
if(!empty($_POST['nom_amis']) and !empty($_POST['nom_fonctioncommission']))
{
connexion();

// Récupération id_amis
$sql1="select id_amis from amis where nom_amis='".$_POST['nom_amis']."'"; 
$resultat1=mysql_query($sql1) or die('erreur exec recet');
$sql3=mysql_fetch_array($resultat1);


// Récupération id_fonctioncommission
$sqla2="select id_fonctioncommission from fonctioncommission where nom_fonctioncommission='".$_POST['nom_fonctioncommission']."'"; 
$resultata2=mysql_query($sqla2) or die('erreur exec recet3');
$resa2=mysql_fetch_array($resultata2);


// Insertion de l'ami et de la commission
$insert="insert into fonctioncommissionami 
values('".$sql3[0]."','".$resa2[0]."','".$_GET['reference2']."')";
mysql_query($insert) or die('erreur insertion: '. $insert. ' '. mysql_error());

deconnexion();

echo "<script>alert(\"L'ami est désormais affecté sur cette commission\");
document.location.href='menusecretaire.php';</script>";
/*header("Location:menusecretaire.php");*/

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