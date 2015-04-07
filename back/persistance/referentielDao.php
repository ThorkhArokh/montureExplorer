<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Faction.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/TypeMonture.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/connectionBDD.php');

function getListFactions() {
    $listFactions = array();

    // on créé la requête SQL
    $connexionBDD = getConnexionBDD();

    $sqlQuery = $connexionBDD->prepare("SELECT f.id , f.nom
		FROM faction f");

    $sqlQuery->execute();
    while ($lignes = $sqlQuery->fetch(PDO::FETCH_OBJ)) {

        $faction = new Faction($lignes->id, $lignes->nom);

        $listFactions[] = $faction;
    }

    closeConnexionBDD($connexionBDD);

    return $listFactions;
}

function getListTypes() {
    $listTypes = array();

    // on créé la requête SQL
    $connexionBDD = getConnexionBDD();

    $sqlQuery = $connexionBDD->prepare("SELECT t.id , t.libelle
		FROM typeMonture t");

    $sqlQuery->execute();
    while ($lignes = $sqlQuery->fetch(PDO::FETCH_OBJ)) {

        $type = new TypeMonture($lignes->id, html_entity_decode($lignes->libelle));

        $listTypes[] = $type;
    }

    closeConnexionBDD($connexionBDD);

    return $listTypes;
}
?>

