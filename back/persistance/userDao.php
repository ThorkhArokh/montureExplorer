<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/User.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/connectionBDD.php');

function isUserExist($login, $password) {

	$connexionBDD = getConnexionBDD();
	
	$res = false;
	$sqlQuery = $connexionBDD->prepare("SELECT u.id FROM user u WHERE u.nom = :login AND u.password = :password");
	$sqlQuery->execute(array( 'login' => $login, 'password' => $password));
    $count = $sqlQuery->rowCount();
    if($count > 0) {
        $res = true;
    }
    
    closeConnexionBDD($connexionBDD);
    
    return $res;
}

function getUserByLogin($login) {
	$connexionBDD = getConnexionBDD();

	$sqlQuery = $connexionBDD->prepare("SELECT u.id, u.nom, u.royaume, u.perso FROM user u WHERE u.nom = :login");
	$sqlQuery->execute(array( 'login' => $login));
    $ligne = $sqlQuery->fetch(PDO::FETCH_OBJ);
   	$userRes = new User($ligne->id, $ligne->nom);
    
    if($ligne->royaume != null && $ligne->perso != null) {
    	
    }
    
    closeConnexionBDD($connexionBDD);
    
    return $userRes;	
}

?>