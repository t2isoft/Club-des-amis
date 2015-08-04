<?php 
//recupération date diner
//$id_anneediner="select date_diner from diner where id_diner='".$resa[0]."'";
//$resultat100=mysql_query($id_anneediner) or die('erreur exec4 ');
//$sql171=mysql_fetch_array($resultat100);

//recupération anne diner
$d2=date("Y-m-d");
list($a,$m,$j)=explode("-",$resultat100);
$annee="$a";
echo $annee;
?>