<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Ajouter un ami</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
            .UpperCase{
                    text-transform: uppercase
            }
</style>
</head>
<body>

<center>
<h3>Ajouter un nouvel ami</h3>


<div class="formulaire">
	<form action="ajouterami.php" method="POST">
		<table>
			<tr><th>Nom:</th><td><input type="text" class="UpperCase" name="nom_amis"></td></tr>
			<tr><th>Prénom:</th><td><input type="text" name="prenom_amis"></td></tr>
			<tr><th>Date entrée</th><td><input type="date" name="date_entree"></td></tr>
			<tr><th>Téléphone fixe:</th><td><input type="number"/ name="tel_fixe"></td></tr>
			<tr><th>Téléphone portable:</th><td><input type="number"/ name="tel_port"></td></tr>
			<tr><th>E-mail:</th><td><input type="text" name="email"></td></tr>
			<tr><th>Numéro adresse:</th><td><input type="number"/ name="num_adr"></td></tr>
			<tr><th>Rue:</th><td><input type="text" name="rue_adr"></td></tr>
			<tr><th>Code Postal:</th><td><input type="text" name="cp_adr"></td></tr>
			<tr><th>Ville:</th><td><input type="text" class="UpperCase" name="ville_adr"></td></tr>
			<tr><th>Premier Parrain</th><td>
				<select name="parrain1"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis, prenom_amis FROM amis"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." ".$liste_val['prenom_amis']."</option>\n"; 
} 
?> 
</select> 
			<tr><th>Deuxième Parrain</th><td>
				<select name="parrain2"> 
<?php 
connexion();

$liste_req = mysql_query("SELECT id_amis, nom_amis, prenom_amis FROM amis"); 
while ($liste_val = mysql_fetch_array($liste_req)) 
{ 
    echo "<option value='".$liste_val['nom_amis']."'>".$liste_val['nom_amis']." ".$liste_val['prenom_amis']."</option>\n"; 
} 
?> 
		</select> 
		</table>
<br>
<input type="submit" value="Ajouter" class="buttonform"> &nbsp;&nbsp;<input type="reset" value="Effacer" class="buttonform">
</form>
</div>
</center>
<?php
if(isset($_POST['nom_amis']) and isset($_POST['prenom_amis']) and isset($_POST['date_entree']) and isset($_POST['tel_fixe']) and isset($_POST['tel_port'])and isset($_POST['email'])and isset($_POST['num_adr']) and isset($_POST['rue_adr']) and isset($_POST['cp_adr'])and isset($_POST['ville_adr'])and isset($_POST['parrain1'])and isset($_POST['parrain2']))
{
if(!empty($_POST['nom_amis']) and !empty($_POST['prenom_amis']) and !empty($_POST['date_entree']) and !empty($_POST['tel_fixe']) and !empty($_POST['tel_port'])and !empty($_POST['email'])and !empty($_POST['num_adr']) and !empty($_POST['rue_adr']) and !empty($_POST['cp_adr'])and !empty($_POST['ville_adr']) and !empty($_POST['parrain1'])and !empty($_POST['parrain2']))
{
connexion();
$sql1="select * from amis where nom_amis='".$_POST['nom_amis']."'
and prenom_amis='".$_POST['prenom_amis']."'"; 
$resultat=mysql_query($sql1) or die('erreur exec recet');
if(mysql_num_rows($resultat)==0)
{
$nomamis=strtoupper($_POST['nom_amis']);
$sql2="insert into amis 
values('','".$nomamis."','".$_POST['prenom_amis']."','".$_POST['date_entree']."','','".$_POST['tel_fixe']."','".$_POST['tel_port']."','".$_POST['email']."','".$_POST['num_adr']."','".$_POST['rue_adr']."','".$_POST['cp_adr']."','".$_POST['ville_adr']."','".$_POST['parrain1']."','".$_POST['parrain2']."')";
mysql_query($sql2) or die('Error :'. $sql2);


echo "<script>alert(\"L'ami est ajouté avec succés \");
document.location.href = 'menusecretaire.php';</script>";

deconnexion();
}
else
alerte('L\'Ami existe déjà');
}
else
alerte('Les champs sont vides');
}
else
//alerte('Les variables non existants');
?>
</body>
</html>
