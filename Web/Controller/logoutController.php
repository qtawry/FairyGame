<?php

namespace Web\Controller;

use Web\Module\mageModule;

class logoutController {

    var $data = array();

    public function indexAction() {
        $player = new mageModule();
        $player->logout();
    }

}
