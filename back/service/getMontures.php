<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Monture.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/RetourService.php';
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/montureDao.php');

session_start();

$resultat = new RetourService();
$idUser = 1;

// On récupère la liste de montures en base
$listeMontures = getListMontures($idUser);

$resultat->setStatus(true);
$resultat->setData($listeMontures);

echo $resultat->toJson();
?>

