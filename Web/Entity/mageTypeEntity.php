<?php

namespace Web\Entity;

use Library\sqlLibrary;

class mageTypeEntity extends sqlLibrary {
    
    public function getAllType(){
        $sql = "select * from MageType;";
        return $this->query($sql);
    }
}
