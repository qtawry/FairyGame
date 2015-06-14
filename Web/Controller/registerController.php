<?php

namespace Web\Controller;

use Library\parserLibrary;
use Web\Module\mageModule;
use Web\Entity\mageTypeEntity;

class registerController {

    var $data = array();

    public function indexAction() {
        $parser = new parserLibrary;
        $player = new mageModule();
        $mageType = new mageTypeEntity();
        $this->data["register"] = $player->register();
        $this->data["mageType"] = $mageType->getAllType();
        $file = $parser->logged(file_get_contents("./Resources/views/pages/register.html"));
        return $parser->parse($file, $this->data);
    }

}
