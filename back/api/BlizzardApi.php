<?php
class BlizzardApi {

    var $URL_BASE;
    var $URL_CHARACTER;
    var $URL_ICONS_BASE;
    var $IMG_EXTENTION;
    var $ARGS_BASE;
    var $ARGS_MOUNTS;
    var $LOCAL;
    
    function __construct() {
        $this->URL_BASE = "http://eu.battle.net";
        $this->URL_CHARACTER = "/api/wow/character";
        $this->URL_ITEM = "/api/wow/item";
        $this->ARGS_BASE = "fields=";
        $this->ARGS_MOUNTS = "mounts";
        $this->LOCAL_BASE = "locale=";
        $this->LOCAL = "fr_FR";
        $this->URL_ICONS_BASE = "http://eu.media.blizzard.com/wow/icons";
        $this->IMG_EXTENTION = ".jpg";
    }

    function getMonturesPerso($personnage, $royaume) {
        $url = $this->URL_BASE.$this->URL_CHARACTER."/".$royaume."/".$personnage."?".$this->ARGS_BASE.$this->ARGS_MOUNTS;
        $url .= "&".$this->LOCAL_BASE.$this->LOCAL;

        $objectJSON = @file_get_contents($url);

        return $objectJSON;
    }
    
    function getMontureById($id) {
    	$url = $this->URL_BASE.$this->URL_ITEM."/".$id;
        $url .= "&".$this->LOCAL_BASE.$this->LOCAL;

        $objectJSON = @file_get_contents($url);

        return $objectJSON;
    }
 
    // $taille : 18, 36, and 56
    function getImagePath($imageName, $taille) {
        $url = $this->URL_ICONS_BASE."/".$taille."/".$imageName.$this->IMG_EXTENTION;
        $img = '../../images/icons/'.$imageName.$this->IMG_EXTENTION;
        echo $img;
        file_put_contents($img, file_get_contents($url));
        return $img;
    }
}
?>

