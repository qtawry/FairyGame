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
        if ($magedetail['level'] == 1){
            $this->data['mageXPMax'] = round(100 * (pow(2, ($magedetail['level'])-1)));
        }
        else{
            $this->data['mageXPMax'] = round(100 * (pow(2, ($magedetail['level'])-1))) -round(100 * (pow(2, ($magedetail['level'])-2)));
        }
        ;
        $this->data['mageXP'] = $magedetail['MageXP'];
        $this->data['magePercentXP'] = ($this->data['mageXP'] / $this->data['mageXPMax']) * 100;
        $this->data['mageGold'] = $magedetail['MageGold'];
        $this->data['mageInfluence'] = $magedetail['MageInfluence'];
        $this->data['mageLevel'] = $magedetail['level'];
        $file = $parser->logged(file_get_contents("./Resources/views/pages/overview.html"));
        return $parser->parse($file, $this->data);
    }

}
