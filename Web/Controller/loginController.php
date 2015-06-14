<?php

namespace Web\Controller;

use Library\parserLibrary;
use Web\Module\mageModule;

class loginController {

    var $data = array();

    public function indexAction() {
        $parser = new parserLibrary;
        $player = new mageModule();
        $this->data["login"] = $player->login();
        $file = $parser->logged(file_get_contents("./Resources/views/pages/login.html"));
        return $parser->parse($file, $this->data);
    }

}
