<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/User.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Monture.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/RetourService.php';
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/montureDao.php');

session_start();

$resultat = new RetourService();

if (isset($_GET['id']) && isset($_SESSION['userConnectME'])) {
	$idMonture = $_GET['id'];
	$user = $_SESSION['userConnectME'];
    $idUser = $user->id;
    if (isMontureFavori($idMonture, $idUser)) {
        deleteFavoriMontureUser($idMonture, $idUser);
    } else {
    	addFavoriMontureUser($idMonture, $idUser);
    }

    $resultat->setStatus(true);
} else {
    $resultat->setStatus(false);
    $resultat->setMessage("Session expirée.");
}

echo $resultat->toJson();
?>

