<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/RetourService.php');

session_start();
$resultat = new RetourService();

if(isset($_SESSION['userConnectME'])) {
	$resultat->setStatus(true);
	$resultat->setData($_SESSION['userConnectME']);
} else {
	$resultat->setStatus(false);
    $resultat->setMessage("Session expirée");
}

echo $resultat->toJson();

?>