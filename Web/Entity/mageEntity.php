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
    
    public function getAttack($mage){
        $attack = $this->query("select MageAttack + (MageTypeAttack * level) from Mage inner join MageIs using (MageId) inner join MageType using (MageTypeId) where MageName = {$mage}");
        var_dump($attack);
        return $attack[0];
    }
    
    public function getHP($mage){
        $attack = $this->query("select MageHP + (MageTypeHP * level) from Mage inner join MageIs using (MageId) inner join MageType using (MageTypeId) where MageName = {$mage}");
        var_dump($attack);
        return $attack[0];
    }
    
    public function getSupport($mage){
        $attack = $this->query("select MageSupport + (MageTypeSupport * level) from Mage inner join MageIs using (MageId) inner join MageType using (MageTypeId) where MageName = {$mage}");
        var_dump($attack);
        return $attack[0];
    }
    
    public function getType($mage){
        $attack = $this->query("select MageTypeName from Mage inner join MageIs using (MageId) inner join MageType using (MageTypeId) where MageName = {$mage}");
        var_dump($attack);
        return $attack[0];
    }
    
    public function getXP($mage){
        $attack = $this->query("select MageXP from Mage where MageName = {$mage}");
        var_dump($attack);
        return $attack[0];
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
