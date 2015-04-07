<?php

class User {
	
	var $id;
	var $login;

	function __construct($id, $login) {
		$this->id = $id;
        $this->login = $login;
    }
    
    function getId() {
		return $this->id;
	}
}

?>