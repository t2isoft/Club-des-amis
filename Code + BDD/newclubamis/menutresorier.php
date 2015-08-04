<?php 
include('fonctions.php');
session_start();
if (isset($_SESSION['login']) and !empty($_SESSION['login']) and ($_SESSION['id_fonctionbureau']==5 or $_SESSION['id_fonctionbureau']==6)) {

connexion();
//recupération annee en cours
$d2 = date("Y-m-d");
list($a,$m,$j)=explode("-",$d2);
$annee="$a";

//récupération id des amis n'ayant pas de relève pour l'année en cours
$amissansreleve="SELECT * FROM amis where date_sortie='0000-00-00'
				and id_amis NOT IN (SELECT id_amis FROM releve
				Where annee_montant='".$annee."')";
$resultat50=mysql_query($amissansreleve) or die('erreur lecture: '. $amissansreleve. ' '. mysql_error());
while($enreg=mysql_fetch_array($resultat50))
{
//insertion d'une relève pour chaque ami n'en ayant pas sur l'année en cours
$sql2="insert into releve 
values('','".$annee."','20','".$enreg['id_amis']."')";
mysql_query($sql2) or die('Error :'. $sql2);
}
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Gestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<center>


<div id='cssmenu'>
<ul>
   <li class='active'><a href='menutresorier.php'><span>Home</span></a></li>
   
    <li class='has-sub last'><a href='#'><span>Gestion des Dîners</span></a>
      <ul>
         <li><a href='ajouterdiner.php'><span>Ajouter un dîner</span></a></li>
         <li><a href='chercherdiner.php'><span>Chercher/Modifier/Supprimer un dîner</span></a></li>
         <li><a href='listerdiner.php'><span>Lister/Modifier/Supprimer des dîners</span></a></li>
         
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Gestion des amis inscrits aux dîners</span></a>
      <ul>
		 <li><a href='inscriptionamidiner.php'><span>Inscrire un Ami à un dîner</span></a></li>
         <li class='last'><a href='listeramiinscritdiner.php'><span>Lister/Supprimer les Amis inscrits à un diner</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Gestion des relevés annuels</span></a>
      <ul>
		 <li><a href='editionreleveami.php'><span>Edition du relevé annuel par ami</span></a></li>
		 <li><a href='editionreleveannee.php'><span>Edition du relevé annuel par année</span></a></li>
      </ul>
   </li>
</ul>
</div>
</center>
<body>
</body>
</html>
<?php
}
else {
echo "<script>alert(\"Vous n'êtes pas autorisé à accéder à cette zone \");
document.location.href = 'index.html';</script>";
}
?>
