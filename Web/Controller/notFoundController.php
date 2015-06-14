<?php

namespace Web\Controller;

use Library\parserLibrary;

class notFoundController {

    var $data = array();

    public function indexAction() {
        $parser = new parserLibrary;
        $file = file_get_contents("./Resources/views/pages/notFound.html");
        return $parser->parse($file, $this->data);
    }

}
