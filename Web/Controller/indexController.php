<?php

namespace Web\Controller;

use Library\parserLibrary;
use Web\Entity\mageEntity;

class indexController {

    var $data = array();

    public function indexAction() {
        $parser = new parserLibrary;
        $file = file_get_contents("./Resources/views/pages/index.html");
        return $parser->parse($file, $this->data);
    }

}
