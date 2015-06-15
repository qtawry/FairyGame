<?php

namespace Web\Module;

use Library\securityLibrary;
use Web\Entity\missionEntity;
use Web\Entity\mageEntity;
use Library\generalLibrary;

class missionModule {

   public function getAllMission(){
       $missionEntity = new missionEntity();
       return $missionEntity->getAll();
   }

    public function accept($id){
        $mageEntity = new mageEntity();
        $missionEntity = new missionEntity();
        $mageId = $mageEntity->getAccount($_SESSION['login'])['MageId'];
        $mission = $missionEntity->getById($id);

        //Check mission damages

        //update Gold influence XP and HP from mage



    }

}
