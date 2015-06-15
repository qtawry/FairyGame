<?php

namespace Web\Entity;

use Library\sqlLibrary;

class missionEntity extends sqlLibrary {
    
    public function getAll(){
        $sql = "select * from Mission;";
        return $this->query($sql);
    }

    public function getById($id){
        $sql = "select * from Mission where MissionId = {$id};";
        return $this->query($sql);
    }

}
