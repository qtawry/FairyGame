<?php

namespace Web\Controller;

use Library\parserLibrary;
use Web\Module\missionModule;
use Web\Module\mageModule;

class cityMissionController {

    var $data = array();

    public function indexAction() {
        $parser = new parserLibrary;
        $missionModule = new missionModule();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $missionModule->accept($id);
        }
        $missions = $missionModule->getAllMission();
        $this->data['missions'] = $missions;
        $file = $parser->logged(file_get_contents("./Resources/views/pages/cityMission.html"));
        return $parser->parse($file, $this->data);
    }

}
