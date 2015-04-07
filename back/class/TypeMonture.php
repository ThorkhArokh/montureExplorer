<?php
class TypeMonture {
    var $id;
    var $libelle;
    
    function __construct($id, $libelle) {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    function show() {
        echo "Id : ".$this->id."<br/>";
        echo "Libellé : ".$this->libelle;
    }
}
