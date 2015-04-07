<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Faction.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/RetourService.php';
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/referentielDao.php');

session_start();

$resultat = new RetourService();

$listeFactions = getListFactions();

$resultat->setStatus(true);
$resultat->setData($listeFactions);

echo $resultat->toJson();
?>

