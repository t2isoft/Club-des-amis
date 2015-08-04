<?php 
include('fonctions.php');
session_start();
if (isset($_SESSION['login']) and !empty($_SESSION['login']) and ($_SESSION['id_fonctionbureau']==3 or $_SESSION['id_fonctionbureau']==4)) {
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
   <li class='active'><a href='menusecretaire.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Gestion des Amis</span></a>
      <ul>
         <li><a href='ajouterami.php'><span>Ajouter un Ami</span></a></li>
         <li><a href='chercherami.php'><span>Chercher/Modifier/Supprimer un Amis</span></a></li>
         <li class='last'><a href='listerami.php'><span>Lister/Modifier/Supprimer des Amis</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Gestion des Actions</span></a>
      <ul>
         <li><a href='ajouteraction.php'><span>Ajouter une Action</span></a></li>
         <li><a href='chercheraction.php'><span>Chercher/Modifier/Supprimer une Action</span></a></li>
         <li><a href='listeraction.php'><span>Lister/Modifier/Supprimer des Actions</span></a></li>
         <li><a href='inscriptionamiaction.php'><span>Inscrire un Ami à une Action</span></a></li>
         <li class='last'><a href='listeramiinscritaction.php'><span>Lister/Supprimer les Amis inscrits à une action</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Gestion des Commissions</span></a>
      <ul>
         <li><a href='ajoutercommission.php'><span>Ajouter une Commission</span></a></li>
         <li class='last'><a href='listercommission.php'><span>Lister/Gérer Commissions</span></a></li>
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