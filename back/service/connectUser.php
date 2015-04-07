<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/RetourService.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/userDao.php');

session_start();

$resultat = new RetourService();

if(isset($_GET['login']) && isset($_GET['password'])) {
	if(isUserExist($_GET['login'], $_GET['password'])) {
		$_SESSION['userConnectME'] = getUserByLogin($_GET['login']);
		$resultat->setStatus(true);
	} else {
		$resultat->setStatus(false);
    	$resultat->setMessage("User ou mot de passe non reconnu");
	}

} else {
	$resultat->setStatus(false);
    $resultat->setMessage("User ou mot de passe non reconnu");
}

echo $resultat->toJson();

?>