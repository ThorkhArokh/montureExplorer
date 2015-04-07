<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/api/BlizzardApi.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/montureExplorer/back/persistance/montureDao.php');

        session_start();

        $blizzardApi = new BlizzardApi();

        if (!isset($_SESSION["wowApiCharWithMounts"])) {
            echo "appel BlizApi";
            $charWithMount = $blizzardApi->getMonturesPerso("cyprecia", "dalaran");
            //$objectJSON = @file_get_contents("http://eu.battle.net/api/wow/character/dalaran/cyprecia?fields=mounts");
            //echo $charWithMount;
            $_SESSION["wowApiCharWithMounts"] = $charWithMount;
        } else {
        	echo "get from session";
            $charWithMount = $_SESSION["wowApiCharWithMounts"];
        }

		$obj = json_decode($charWithMount);
		//print_r($obj);
        for($i = 0; $i < count($obj->mounts->collected); ++$i) {
            $monture = $obj->mounts->collected[$i];

            $imgPath = $blizzardApi->getImagePath($monture->icon, 56);
			
            //echo $monture->name;
			
			$id = getMontureByName($monture->name);
			if($id != null) {
				
			}
        }
?>