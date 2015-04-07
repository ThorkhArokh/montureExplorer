<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/TypeMonture.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/RetourService.php';
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/referentielDao.php');

session_start();

$resultat = new RetourService();

$listeTypes = getListTypes();

$resultat->setStatus(true);
$resultat->setData($listeTypes);

echo $resultat->toJson();
?>

