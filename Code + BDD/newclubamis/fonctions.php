<?php
//fonction pour la connexion au serveur et la base
function connexion(){
mysql_connect('localhost','root','jb29111984') or die('Impossible d\'acceder au serveur');
mysql_select_db('newclubamis') or die('Impossible d\'acceder à la base');
mysql_query("SET NAMES UTF8"); 
}

function alerte($ch)
{
$code="<script type=\"text/javascript\">";
$code.="alert('$ch');";
$code.="</script>";
echo $code;
}

function deconnexion()
{
mysql_close();
}
?>