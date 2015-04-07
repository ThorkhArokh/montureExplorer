<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Monture.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Faction.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/TypeMonture.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/connectionBDD.php');

// Fonction qui retourne la liste des montures 
function getListMontures($idUser) {
    $listMontures = array();

    // on créé la requête SQL
    $connexionBDD = getConnexionBDD();

    $sqlQuery = $connexionBDD->prepare("SELECT m.id , m.nom, m.lien, m.description, 
        m.cout, m.pnj, m.lieu, m.reputation, m.prerequis, m.icon,
        f.id as idFaction, f.nom as nomFaction, 
        t.id as idTypeMonture, t.libelle as lblTypeMonture
		FROM typeMonture AS t, monture AS m 
                LEFT JOIN faction AS f  ON m.idFaction = f.id
                WHERE m.idType = t.id");

    $sqlQuery->execute();
    while ($lignes = $sqlQuery->fetch(PDO::FETCH_OBJ)) {
        // On créé la monture
        //echo html_entity_decode($lignes->description);
        $monture = new Monture($lignes->id, html_entity_decode($lignes->nom), html_entity_decode($lignes->description));
        if($lignes->icon != null) {
        	$monture->setIcon($lignes->icon);
        } else {
        	
        }
        
        if ($lignes->idFaction != null) {
            // On créé la faction
            $faction = new Faction($lignes->idFaction, $lignes->nomFaction);
            $monture->setFaction($faction);
        }
        // On crée le type de monture
        $typeMonture = new TypeMonture($lignes->idTypeMonture, $lignes->lblTypeMonture);
        $monture->setType($typeMonture);
        
        $monture->setIsObtenu(isMontureObtenu($lignes->id, $idUser));
        $monture->setIsFavoris(isMontureFavori($lignes->id, $idUser));
        
        //Champs facultatifs
        $monture->cout = $lignes->cout;
        $monture->pnj = $lignes->pnj;
        $monture->lieu = $lignes->lieu;
        $monture->reputation = $lignes->reputation;
        $monture->prerequis = $lignes->prerequis;
        
        $listMontures[] = $monture;
    }

    closeConnexionBDD($connexionBDD);
    
    return $listMontures;
}

function getMontureByName($name) {
	
	$connexionBDD = getConnexionBDD();
	$nameTmp = htmlentities($name);
	$nameTmp = str_replace('\'', '&rsquo;', $nameTmp);
	echo "getMontureByName : ".$nameTmp;
	$sqlQuery = $connexionBDD->prepare("SELECT m.id FROM monture m WHERE m.nom like :name");
	$sqlQuery->execute(array( 'name' => '%'.$nameTmp.'%'));
    $ligne = $sqlQuery->fetch(PDO::FETCH_OBJ);
    $count = $sqlQuery->rowCount();
    echo $count;
    $idMonture = null;
    if($count > 0) {
    	echo " Trouv�e => ".$ligne->id;
   		$idMonture = $ligne->id;
    }
    
    echo "</br>";
    
    closeConnexionBDD($connexionBDD);
    
    return $idMonture;	
}

function isMontureObtenu($idMonture, $idUser) {
    $connexionBDD = getConnexionBDD();
    
    $res = false;
    $sqlQuery = $connexionBDD->prepare("SELECT idMonture, idUser from montureUser where idMonture = :idMonture and idUser = :idUser");
    $sqlQuery->execute(array( 'idMonture' => $idMonture, 'idUser' => $idUser));
    $count = $sqlQuery->rowCount();
    if($count > 0) {
        $res = true;
    }
    
    return $res;
}

function isMontureFavori($idMonture, $idUser) {
    $connexionBDD = getConnexionBDD();
    
    $res = false;
    $sqlQuery = $connexionBDD->prepare("SELECT idMonture, idUser from favoris where idMonture = :idMonture and idUser = :idUser");
    $sqlQuery->execute(array( 'idMonture' => $idMonture, 'idUser' => $idUser));
    $count = $sqlQuery->rowCount();
    if($count > 0) {
        $res = true;
    }
    
    return $res;
}

function addMontureUser($idMonture, $idUser) {
    $connexionBDD = getConnexionBDD();
    $connexionBDD->beginTransaction();

    $sqlQueryInsert = $connexionBDD->prepare("insert into montureUser (idMonture, idUser) values (:idMonture, :idUser)");
    $sqlQueryInsert->execute(array( 'idMonture' => $idMonture, 'idUser' => $idUser));
    $connexionBDD->commit();
    
    closeConnexionBDD($connexionBDD);
}

function deleteMontureUser($idMonture, $idUser) {
    $connexionBDD = getConnexionBDD();
    $connexionBDD->beginTransaction();
    
    $sqlQueryDelete = $connexionBDD->prepare("delete from montureUser where idMonture = :idMonture and idUser = :idUser");
    $sqlQueryDelete->execute(array( 'idMonture' => $idMonture, 'idUser' => $idUser));
    $connexionBDD->commit();
    
    closeConnexionBDD($connexionBDD);
}

function addFavoriMontureUser($idMonture, $idUser) {
    $connexionBDD = getConnexionBDD();
    $connexionBDD->beginTransaction();

    $sqlQueryInsert = $connexionBDD->prepare("insert into favoris (idMonture, idUser) values (:idMonture, :idUser)");
    $sqlQueryInsert->execute(array( 'idMonture' => $idMonture, 'idUser' => $idUser));
    $connexionBDD->commit();
    
    closeConnexionBDD($connexionBDD);
}

function deleteFavoriMontureUser($idMonture, $idUser) {
    $connexionBDD = getConnexionBDD();
    $connexionBDD->beginTransaction();
    
    $sqlQueryDelete = $connexionBDD->prepare("delete from favoris where idMonture = :idMonture and idUser = :idUser");
    $sqlQueryDelete->execute(array( 'idMonture' => $idMonture, 'idUser' => $idUser));
    $connexionBDD->commit();
    
    closeConnexionBDD($connexionBDD);
}

?>