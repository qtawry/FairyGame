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
        $mageUpdated = $mageEntity->getAccount($_SESSION['login'])[0];
        $mageId = $mageUpdated['MageId'];
        unset ($mageUpdated['MageId']);
        $mission = $missionEntity->getById($id);

        //Check mission damages
        
        /* Magelevel vs MissionLevel
         * MageAttack * 2 + Support
         * MageHP
         * difficulty = MissionLevel - (MageLevel - MissionMage)
         * HP += Atk * 2 + Support - difficulty * rand(3,5) 
         * 
         * EX : Mage 1 Mission 2 => difficulty = 3
         *      HP  += 7 - 3 * (3,5)    => -2 to -8
         * 
         * EX : Mage 1 Mission 1 => difficulty = 1
         *      HP  += 7 - 1 * (3,5)        => +4 to +2
         * 
         * EX : Mage 2 Mission 2 => difficulty = 2
         *      HP  += 14 - 2 * (3,5)       => +8 to +4
         * 
         * EX : Mage 2 Mission 4 => difficulty = 6
         *      HP  += 14 - 6 * (3,5)       => -4 to -16
         */

        //update Gold influence XP and HP from mage
        $mageUpdated['MageXP'] += $mission['MissionXP'];
        $mageUpdated['MageGold'] += $mission['MissionGold'];
        $mageUpdated['MageInfluence'] += $mission['MissionInfluence'];
        $mageEntity->updateMage($mageUpdated, $mageId);
        $mage = $mageEntity->getInfos($mageUpdated['MageName']);
        //level up if necessary
        if ($mage['level'] == 1 && $mage['MageXP'] >= round(100 * (pow(2, ($mage['level']-1)))) ||
            $mage['level']>1 && $mage['MageXP'] >= round(100 * (pow(2, ($mage['level'])-1))) -round(100 * (pow(2, ($mage['level'])-2)))){
            $mageEntity->levelUp($mage['MageName']);
        }

        header('Location: index.php?pages=overview');
        exit;



    }

}
