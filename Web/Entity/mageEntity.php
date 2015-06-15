<?php

namespace Web\Entity;

use Library\sqlLibrary;

class mageEntity extends sqlLibrary {
    public function newAccount($Pseudo, $MotDePasse, $Email, $mageType){
        $sql = "INSERT  INTO Mage(MageName, MagePwd, MageMail) VALUES ('$Pseudo', '$MotDePasse','$Email');";
        $this->query($sql,$idMage);
        
        
        $sql = "INSERT  INTO MageIs(MageId, MageTypeId, level) VALUES ({$idMage}, {$mageType},1);";
        $this->query($sql);
        
    }
    
    public function getAccount($pseudo){
        $sql = "select * from Mage where MageName = '$pseudo';";
        return $this->query($sql);
    }
    
    public function getInfos($mage){
        $attack = $this->query("select "
                . "MageName, "
                . "MageTypeName, "
                . "MageSupport + (MageTypeSupport * level) as MageSupport, "
                . "MageXP, "
                . "MageHP + (MageTypeHP * level) as MageHP, "
                . "MageAttack + (MageTypeAttack * level) as MageAttack, "
                . "level "
                . "from Mage inner join MageIs using (MageId) inner join MageType using (MageTypeId) where MageName = '{$mage}'");
        return $attack[0];
    }
}
