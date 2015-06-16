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
        $mageUpdated = $mageEntity->getAccount($_SESSION['login']);
        $mageId = $mageUpdated['MageId'];
        unset ($mageUpdated['MageId']);
        $mission = $missionEntity->getById($id);

        //Check mission damages

        //update Gold influence XP and HP from mage
        $mageUpdated['MageXP'] += $mission['MissionXP'];
        $mageUpdated['MageGold'] += $mission['MissionGold'];
        $mageUpdated['MageInfluence'] += $mission['MissionInfluence'];
        $mageEntity->updateMage($mageUpdated, $mageId);
        $mage = $mageEntity->getInfos($mageUpdated['MageName']);
        //level up if necessary
        if ($mage['level'] == 1 && $mage['MageXP'] >= round(100 * (pow(2, ($mage['level']-1)))) ||
            $mage['MageXP'] >= round(100 * (pow(2, ($mage['level'])-1))) -round(100 * (pow(2, ($mage['level'])-2)))){
            $mageEntity->levelUp($mage['MageName']);
        }

        header('Location: index.php?pages=overview');
        exit;



    }

}
