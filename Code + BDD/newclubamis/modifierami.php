<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Modifier un ami</title>
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
$sql1="select * from amis where id_amis='".$_GET['reference']."'";
$r1=mysql_query($sql1);
while($enreg=mysql_fetch_array($r1))
{
?>
<center>
<h3>Modification d'un ami</h3>
<div class="tableau">
<form action="modifierami.php" method="post">
<table >
<tr><td bgcolor="#C6C1B0">Nom Amis</td><td><input type="text" class="UpperCase" name="nom_amis" 
value="<?php echo $enreg['nom_amis']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Prénom Amis</td><td><input type="text" 
name="prenom_amis" value="<?php echo $enreg['prenom_amis']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Date Entrée</td><td><input readonly="readonly" input type="date" name="date_entree" 
value="<?php echo $enreg['date_entree']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Téléphone fixe</td><td><input type="number"/ name="tel_fixe" 
value="<?php echo $enreg['tel_fixe']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Téléphone portable</td><td><input type="number"/ name="tel_port" 
value="<?php echo $enreg['tel_port']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Email</td><td><input type="text" name="email" 
value="<?php echo $enreg['email']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Numéro de la rue</td><td><input type="number"/ name="num_adr" 
value="<?php echo $enreg['num_adr']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Nom de la rue</td><td><input type="text" name="rue_adr" 
value="<?php echo $enreg['rue_adr']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Code Postal</td><td><input type="number"/ name="cp_adr" 
value="<?php echo $enreg['cp_adr']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Ville</td><td><input type="text" class="UpperCase" name="ville_adr" 
value="<?php echo $enreg['ville_adr']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Parrain 1</td><td><input readonly="readonly" input type="text" name="parrain1" 
value="<?php echo $enreg['parrain1']; ?>"></td></tr>
<tr><td bgcolor="#C6C1B0">Parrain 2</td><td><input readonly="readonly" input type="text" name="parrain2" 
value="<?php echo $enreg['parrain2']; ?>"></td></tr>
</table>
<input type="submit" value="Modifier"> &nbsp;&nbsp;<input type="reset" value="Annuler">
<input type="hidden" name="reference" value="<?php echo $_GET['reference']; ?>">
</form>
</center>
<?php
deconnexion();
}
}
// mise à jour de l'ami
if(isset($_POST['nom_amis']) and isset($_POST['prenom_amis']) and isset($_POST['date_entree'])and isset($_POST['tel_fixe'])and isset($_POST['tel_port'])and isset($_POST['email'])
and isset($_POST['num_adr'])and isset($_POST['rue_adr'])and isset($_POST['cp_adr'])and isset($_POST['ville_adr'])and isset($_POST['parrain1'])and isset($_POST['parrain2']))
{
connexion();
$nomamis=strtoupper($_POST['nom_amis']);
$sql="update amis set nom_amis='".$nomamis."', prenom_amis='".$_POST['prenom_amis']."',  date_entree='".$_POST['date_entree']."', tel_fixe='".$_POST['tel_fixe']."',
tel_port='".$_POST['tel_port']."', email='".$_POST['email']."', num_adr='".$_POST['num_adr']."', rue_adr='".$_POST['rue_adr']."', cp_adr='".$_POST['cp_adr']."', ville_adr='".$_POST['ville_adr']."',
parrain1='".$_POST['parrain1']."', parrain2='".$_POST['parrain2']."' where id_amis= '".$_POST['reference']."'";
mysql_query($sql);
echo "<script>alert(\"La modification a été faite avec succés \");
document.location.href = 'menusecretaire.php';</script>";
}
?>
</div>
</body>
</html>