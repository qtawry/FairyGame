<?php

namespace Web\Controller;

use Library\parserLibrary;
use Web\Entity\mageEntity;

class overviewController {

    var $data = array();

    public function indexAction() {
        $parser = new parserLibrary;
        $mageEntity = new mageEntity();
        $magedetail = $mageEntity->getInfos($_SESSION['login']);
        $this->data['mageName'] = $magedetail['MageName'];
        $this->data['mageType'] = $magedetail['MageTypeName'];
        $this->data['mageAttack'] = $magedetail['MageAttack'];
        $this->data['mageHP'] = $magedetail['MageHP'];
        $this->data['mageSupport'] = $magedetail['MageSupport'];
        $this->data['mageXP'] = $magedetail['MageXP'];
        $this->data['magePercentXP'] = $magedetail['MageXP'] / ($magedetail['level']);
        $this->data['mageXPMax'] = 100 * $magedetail['level'];
        $this->data['mageGold'] = $magedetail['MageGold'];
        $this->data['mageInfluence'] = $magedetail['MageInfluence'];
        $file = $parser->logged(file_get_contents("./Resources/views/pages/overview.html"));
        return $parser->parse($file, $this->data);
    }

}
