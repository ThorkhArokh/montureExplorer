<?php

class Faction {
    var $id;
    var $nom;
    
    function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }
    
    function show() {
        echo "Id : ".$this->id."<br/>";
        echo "Nom : ".$this->nom;
    }

}

?>