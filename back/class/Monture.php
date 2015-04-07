<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/Faction.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/class/TypeMonture.php');

class Monture {
    var $id;
    var $nom;
    var $description;
    var $isObtenu;
    var $faction;
    var $type;
    var $cout;
    var $pnj;
    var $lieu;
    var $reputation;
    var $prerequis;
    var $isFavoris;
    var $icon;
    
    function __construct($id, $nom, $description) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
    }
    
    function show() {
        echo "Id : ".$this->id."<br/>";
        echo "Nom : ".$this->nom."<br/>";
        echo "Description : ".$this->description."<br/>";
        echo "IsObtenu : ".$this->isObtenu."<br/>";
        echo "Faction : <br/>";
        if($this->faction != null) {
            $this->faction->show();
        }
        echo "<br/>Type : <br/>";
        $this->type->show();
    }
    
    function checkObtenu(){
        $this->isObtenu = !$this->isObtenu;
    }
    
    function setFaction($faction) {
        $this->faction = $faction;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setIsObtenu($isObtenu) {
        $this->isObtenu = $isObtenu;
    }

	function setIsFavoris($isFavoris) {
		$this->isFavoris = $isFavoris;
	}
	
	function setIcon($icon) {
		$this->icon = $icon;
	}
}
