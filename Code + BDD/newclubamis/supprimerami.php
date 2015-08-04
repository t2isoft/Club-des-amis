<?php 
include('menusecretaire.php');
?>
<html>
<head>
<link rel ="stylesheet" href="style.css" name="text/css"/>
<title>Suppression d'ami</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<center>
<?php
connexion();
$d2 = date("Y-m-d");

	$sql10="select * from manger, amis, diner where 
	manger.id_amis=amis.id_amis
	and manger.id_diner=diner.id_diner
	and diner.date_diner>='".$d2."'
	and amis.id_amis='".$_GET['reference']."'"; 
	$resultat10=mysql_query($sql10) or die('erreur exec recet');
	if(mysql_num_rows($resultat10)==0)
	{
		$sql20="select * from participer, amis, action where 
		participer.id_amis=amis.id_amis
		and participer.id_action=action.id_action
		and action.date_fin>='".$d2."'
		and amis.id_amis='".$_GET['reference']."'"; 
		$resultat20=mysql_query($sql20) or die('erreur exec recet');
		if(mysql_num_rows($resultat20)==0)
		{
		
			$sql30="select * from commission, amis, fonctioncommission, fonctioncommissionami 
			where amis.id_amis=fonctioncommissionami.id_amis
			and commission.id_com=fonctioncommissionami.id_com
			and fonctioncommission.id_fonctioncommission=fonctioncommissionami.id_fonctioncommission
			and commission.datefin_commission>='".$d2."'
			and amis.id_amis='".$_GET['reference']."'";
			$resultat30=mysql_query($sql30) or die('erreur exec recet');
			if(mysql_num_rows($resultat30)==0)
			{	
				
					$sql40="select * from bureau, amis, fonctionbureau, fonctionbureauami 
					where amis.id_amis=fonctionbureauami.id_amis
					and bureau.id_bureau=fonctionbureauami.id_bureau
					and fonctionbureau.id_fonctionbureau=fonctionbureauami.id_fonctionbureau
					and bureau.datefin_bureau>='".$d2."'
					and amis.id_amis='".$_GET['reference']."'";
					$resultat40=mysql_query($sql40) or die('erreur exec recet');
					if(mysql_num_rows($resultat40)==0)
					{
				
				
							
								$sql="update amis set date_sortie='".$d2."' where id_amis='".$_GET['reference']."'";
								mysql_query($sql) or die('erreur de mise à jour');
								echo "<script>alert(\"L\'ami a été supprimé avec succés \");
								document.location.href = 'menusecretaire.php';</script>";
					}
					else
					{
					echo "<script>alert(\"L'ami occupe une fonction au sein du bureau\");
				document.location.href='listerami.php';</script>";
					}
				
			
			}
			else
			{
			echo "<script>alert(\"L'ami occupe une fonction sur une commission en cours à venir\");
			document.location.href='listerami.php';</script>";
			}
		}
		else
		{
		echo "<script>alert(\"L'ami est encore inscrit à une action à venir\");
		document.location.href='listerami.php';</script>";
		}

	}
	else
	{
	echo "<script>alert(\"L'ami est encore inscrit sur un dîner à venir\");
	document.location.href='listerami.php';</script>";
	}



?>
</center>
</body>
</html>
