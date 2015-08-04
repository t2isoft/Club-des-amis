<?php
include('fonctions.php');
// On démarre la session
session_start();
$loginOK = false;  

// On n'effectue les traitement qu'à la condition que 
// les informations aient été effectivement postées
if ( isset($_POST) && (!empty($_POST['login'])) && (!empty($_POST['password'])) ) {

  extract($_POST);  // je vous renvoie à la doc de cette fonction
  
  //Connexion à la base
connexion();
$d2 = date("Y-m-d");
  // On va chercher le mot de passe afférent à ce login
  $sql = "select * from fonctionbureauami, amis, bureau
  where fonctionbureauami.id_amis=amis.id_amis
  and fonctionbureauami.id_bureau=bureau.id_bureau
  and login='".$login."'";
  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
  
  // On vérifie que l'utilisateur existe bien
  if (mysql_num_rows($req) > 0) {
     $data = mysql_fetch_assoc($req);
    
    // On vérifie que son mot de passe est correct, qu'il n'est pas sorti et que le bureau sur lequel il est affecté est toujours d'actualité
    if (($password == $data['password']) and ($data['date_sortie']==0) and ($data['datecreation_bureau']<=$d2) and ($data['datefin_bureau']>=$d2)){
      $loginOK = true;
    }
  }
}

// Si le login a été validé on met les données en sessions
if ($loginOK) {
  $_SESSION['login'] = $data['login'];
   $_SESSION['password'] = $data['password'];
  $_SESSION['id_fonctionbureau'] = $data['id_fonctionbureau'];
  
    if (($data['id_fonctionbureau']==3) or ($data['id_fonctionbureau']==4)){
  header('Location: menusecretaire.php');      
} 
else if (($data['id_fonctionbureau']==5) or ($data['id_fonctionbureau']==6)){
  header('Location: menutresorier.php'); 
  }
}
else {
  echo "<script>alert(\"Merci de vous authentifier \");
document.location.href = 'index.html';</script>";
}
?>
