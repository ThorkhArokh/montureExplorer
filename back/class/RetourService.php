<?php

class RetourService {
    
    var $resultat = array();
    
    function __construct() {
        $resultat['success'] = false;
        $resultat['data'] = "";
        $resultat['message'] = "";
    }
    
    function setStatus($status) {
        $this->resultat['success'] = $status;
    }
    
    function setData($data) {
        $this->resultat['data'] = $data;
    }
    
    function setMessage($message) {
        $this->resultat['message'] = $message;
    }

    function toJson() {
        return json_encode($this->resultat);
    }
    
}
