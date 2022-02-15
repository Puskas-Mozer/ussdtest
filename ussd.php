<?php
//Connection à la base de données
$user ='root';
$host= 'localhost';
$password='';
$BD='BDD_PHARMACIE';
//connection au serveur
$con=mysql_connect($host,$user,$password);
//selection de la base de donnee
$sel=mysql_select_db($BD);


//Lecture des variables envoyées pas POST
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$text = $_POST["text"];

// C'est le menu général de l'applicatif
if($text=""){
	$response="Bienvenus au menu général de la pharmacie de garde \n";
	$response .="1. Pharmacie \n";
	$response .="2. Médicament par pharmacie \n";
	$response .="3. Quitter \n";
	}


//C'est le sous-menu de 1ère option du menu général
else if($text=="1"){
	$response="Menu des pharmacies \n";
	$response .="1. Toutes les pharmacies \n";
	$response .="2. Pharmacies de garde \n";
	$response .="3. Pharmacie par ville \n";
	$response .="4. Pharmacie par arrondissement \n";
	$response .="5. Retour \n";
	$response .="6. Quitter \n";
}


//Sélection du compte d'une pharmacie donnée
else if($text=="2"){
	$response="Taper Entrée, le nom d'une pharmacie, puis Ok \n";
    $response = mysql_query("select * from PHARMACIE where LIB_LIB_PHARMA like '%". $_POST["libPharma"]."%' order by ID_PHARMA");
						while($pharma = mysql_fetch_array($response)){
						echo 
						$pharma["LIB_PHARMA"];
						$libPharma=$_POST["libPharma"];

	$response .="1. Retour \n";
	$response .="2. Quitter \n";
	//Sélection d'un médicament dans le compte de la pharmacie sélectionnée
    }
    $response="Taper Entrée, le nom d'un médicament, puis Ok \n";
    $response = mysql_query("select * from MEDICAMENT where LIB_LIB_MEDICAMENT like '%". $_POST["text"]."%' where  ID_PHARMA==$libPharma");
						while($prefect = mysql_fetch_array($response)){
						echo 
						$prefect["LIB_MEDICA"];
						$prefect["PRIX_MEDICA"];
	$response .="1. Retour \n";
	$response .="2. Quitter \n";
    }  
}
//C'est une option permettant de quitter
else if($text=="3"){
	$response="CON Voulez-vous vraiment quitter? \n";
	$response="Tapez 1 pour quitter \n";
	$response="Taper 0 pour annuler \n";
}


//C'est arrière menu de sous menu 1 du premier menu
else if (($text=="1*1")) {
	$response="Liste de toutes les pharmacies \n";
				$req="select * from PHARMACIE";
				$ex=mysql_query($req);
				while($response=mysql_fetch_array($ex)){
				echo
				    $response['LIB_PHARMA'];
    $response .="1. Retour \n";
	$response .="2. Quitter \n";
    }
}

//Pharmacie de garde
else if ($text=="1*2"){
	$response="Liste des pharmacie qui sont de garde \n";
				$response = mysql_query("select * from PHARMACIE where ID_ETATPHARMA ='Pharmacie de garde'");
						while($etatPharma = mysql_fetch_array($response)){
						echo 
						 
							 $etatPharma["LIB_PHARMA"];
    $response .="1. Retour \n";
	$response .="2. Quitter \n";
    }
}
// Recherche d'une pharmacie	
else if ($text=="1*3"){
	$response="Taper Entrée, le nom d'une pharmacie, puis Ok \n";
$response = mysql_query("select * from PHARMACIE where LIB_VILLE like '%". $_POST["text"]."%' order by ID_PHARMA");
						while($prefect = mysql_fetch_array($response)){
						echo 
						$prefect["LIB_PHARMA"];
	$response .="1. Retour \n";
	$response .="2. Quitter \n";
    }
}

//C'est arrière menu de sous menu 4 du premier menu
else if ($text=="1*4"){
	$response="Taper Entrée, le nom d'une pharmacie, puis Ok \n";
$response = mysql_query("select * from ARRONDISSEMENT where LIB_ARROND like '%". $_POST["text"]."%' order by ID_PHARMA");
						while($prefect = mysql_fetch_array($response)){
						echo 
						$prefect["LIB_PHARMA"];
	$response .="1. Retour \n";
	$response .="2. Quitter \n";
    }
}

//Retour au menu général
else if ($text=="1*5"){
$response="Bienvenus au menu général de la pharmacie de garde \n";
	$response .="1. Pharmacie \n";
	$response .="2. Médicament par pharmacie \n";
	$response .="3. Quitter \n";
	}

//Quitter
else if ($text=="1*6"){
$response="END ";
}
else if ($text=="2*1"){
$response="Taper Entrée, le nom d'une pharmacie, puis Ok \n";
$response = mysql_query("select * from ARRONDISSEMENT where LIB_ARROND like '%". $_POST["text"]."%' order by ID_PHARMA");
						while($prefect = mysql_fetch_array($response)){
						echo 
						$prefect["LIB_PHARMA"];
						
	$response .="1. Retour \n";
	$response .="2. Quitter \n";
    }
}
//Retour
else if ($text=="2*2"){
$response="Bienvenus au menu général de la pharmacie de garde \n";
	$response .="1. Pharmacie \n";
	$response .="2. Médicament par pharmacie \n";
	$response .="3. Quitter \n";
	}
//Quitter
else if ($text=="2*3"){
$response="END ";
}
//Retour
else if ($text=="1*1*1"){
$response="Menu des médicaments  \n";
	$response .="1. Taper une pharmacie \n";
	$response .="2. Retour \n";
	$response .="3. Quitter \n";
}
// Quitter
else if ($text=="1*1*2"){
$response="END ";
}
//Retour
else if ($text=="1*2*1"){
$response .="1. Toutes les pharmacies \n";
	$response .="2. Pharmacies de garde \n";
	$response .="3. Pharmacie par ville \n";
	$response .="4. Pharmacie par arrondissement \n";
	$response .="5. Retour \n";
	$response .="6. Quitter \n";
}
//Quitter
else if ($text=="1*2*2"){
$response="END ";
}
//Retour
else if ($text=="1*3*1"){
$response .="1. Toutes les pharmacies \n";
	$response .="2. Pharmacies de garde \n";
	$response .="3. Pharmacie par ville \n";
	$response .="4. Pharmacie par arrondissement \n";
	$response .="5. Retour \n";
	$response .="6. Quitter \n";
}
//Quitter
else if ($text=="1*3*2"){
$response="END ";
}
//Retour
else if ($text=="1*4*1"){
$response .="1. Toutes les pharmacies \n";
	$response .="2. Pharmacies de garde \n";
	$response .="3. Pharmacie par ville \n";
	$response .="4. Pharmacie par arrondissement \n";
	$response .="5. Retour \n";
	$response .="6. Quitter \n";
}
//Quitter
else if ($text=="1*4*2"){
$response="END ";
}
//Retour
else if ($text=="2*1*1"){
$response="Menu des médicaments  \n";
	$response .="1. Taper une pharmacie \n";
	$response .="2. Retour \n";
	$response .="3. Quitter \n";
}
//Retour
else if ($text=="2*1*2"){
$response="END ";
}

?>