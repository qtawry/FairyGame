<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ProjetJeux : installation</title>

        <link rel="stylesheet" href="../Web/public/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Web//public/css/design.css">


    </head>
    <body>
        
    </body>
</html><?php

function __autoload($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require_once('../' . $path . '.php');
}

use Web\Resources\config;
use Library\sqlLibrary;

$timestart = microtime(true);
$host = config::DB_HOST;
$dbname = config::DB_NAME;
$username = config::DB_USERNAME;
$password = config::DB_PASSWORD;

$nbCountry = config::MAX_COUNTRY;
$nbCity = config::MAX_CITY;
$nbGuild = config::MAX_GUILD;

$db = new sqlLibrary();

$mageType = array(
    "Feu" => array(0, 10, 3, 1),
    "Glace" => array(0, 10, 3, 1),
    "Eau" => array(0, 20, 1, 1),
    "Vent" => array(0, 12, 2, 2)
);

$ressources = array(
    "Argent"=>0,
    "Influence"=>0
);

$buildings = array(
    "Dortoir"           =>  0,
    "Bar"               =>  0,
    "Marchand"          =>  0, 
    "Tableau de mission"=>  0);

$artefacts = array(
    "Potion de soin 1" => array(0,"Rend 10 PV"),
    "Potion de soin 2" => array(0,"Rend 50 PV"),
    "Potion de soin 3" => array(0,"Rend 100 PV"),
    "Potion de soin 4" => array(0,"Rend 500 PV"),
    "Gemme de pouvoir" => array(0,"+20 attaque"),
);

try {
    echo "<p>Create database";
    if (file_exists("../Sql/installation.sql")) {
        $query = file_get_contents("../Sql/installation.sql");
        $db->query($query);
    } else {
        throw new Exception("Database file not found");
    }
    echo "<span class='label label-success'>DONE</span></p>";

    echo "<p>Create all kind of mage";
    foreach ($mageType as $type => &$attributes) {
        $query = "insert into MageType (MageTypeId, MageTypeName, MageTypeHP, MageTypeAttack, MageTypeSupport) values (NULL, '$type', $attributes[1], $attributes[2], $attributes[3])";
        $db->query($query, $attributes[0]);
    }
    echo "<span class='label label-success'>DONE</span></p>";

    echo "<p>Generating mage effects";
    $query = "insert into TypeEffect (MageTypeAttack, MageTypeDef, Modifier) values (" . $mageType['Feu'][0] . "," . $mageType['Glace'][0] . ",2)";
    $db->query($query);
    $query = "insert into TypeEffect (MageTypeAttack, MageTypeDef, Modifier) values (" . $mageType['Glace'][0] . "," . $mageType['Vent'][0] . ",2)";
    $db->query($query);
    $query = "insert into TypeEffect (MageTypeAttack, MageTypeDef, Modifier) values (" . $mageType['Eau'][0] . "," . $mageType['Feu'][0] . ",2)";
    $db->query($query);
    $query = "insert into TypeEffect (MageTypeAttack, MageTypeDef, Modifier) values (" . $mageType['Vent'][0] . "," . $mageType['Eau'][0] . ",2)";
    $db->query($query);
    echo "<span class='label label-success'>DONE</span></p>";

    echo "<p>Creating ressources";
    foreach ($ressources as $res => &$id) {
        $query = "insert into Ressources (ResName) values ('$res')";
        $db->query($query,$id);
    }
    echo "<span class='label label-success'>DONE</span></p>";

    echo "<p>Creating Countries and cities";
    for ($country = 0; $country < $nbCountry; $country++) {
        $query = "insert into Country (CountryName) values ('Country " . ($country + 1) . "')";
        $db->query($query, $countryid);
        for ($city = 0; $city < $nbCity; $city++) {
            $query = "insert into City (CityName, CountryId) values ('City $country$city', $countryid)";
            $db->query($query);
        }
    }
    echo "<span class='label label-success'>DONE</span></p>";
    
    echo "<p>Creating Buildings";
    foreach ($buildings as $building=>&$id) {
        $db->query("insert into Building values (NULL, '".$building."');",$id);
    }
    echo "<span class='label label-success'>DONE</span></p>";
    
    echo "<p>Creating Artefact";
    foreach ($artefacts as $artefact => &$attributes) {
        $db->query("insert into Artefact values (NULL, '".$artefact."', '".$attributes[1]."');", $attributes[0]);
    }
    echo "<span class='label label-success'>DONE</span></p>";
    
    echo "<p>Creating Artefact requirements";
    $db->query("insert into Required(ArtefactId, BuildingId, RequiredLevel)  values (".$artefacts["Potion de soin 1"][0].",".$buildings["Bar"][0].", 1);");
    $db->query("insert into Required(ArtefactId, BuildingId, RequiredLevel)  values (".$artefacts["Potion de soin 2"][0].",".$buildings["Bar"][0].", 3);");
    $db->query("insert into Required(ArtefactId, BuildingId, RequiredLevel)  values (".$artefacts["Potion de soin 3"][0].",".$buildings["Bar"][0].", 5);");
    $db->query("insert into Required(ArtefactId, BuildingId, RequiredLevel)  values (".$artefacts["Potion de soin 4"][0].",".$buildings["Bar"][0].", 7);");
    $db->query("insert into Required(ArtefactId, BuildingId, RequiredLevel)  values (".$artefacts["Gemme de pouvoir"][0].",".$buildings["Marchand"][0].", 3);");
    
    echo "<span class='label label-success'>DONE</span></p>";
    
    echo "<p>Creating Buildings costs";
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Argent'][0]},{$buildings['Dortoir'][0]},1000);");
    
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Argent'][0]},{$buildings['Bar'][0]},1000);");
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Influence'][0]},{$buildings['Bar'][0]},10);");
    
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Argent'][0]},{$buildings['Marchand'][0]},10000);");
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Influence'][0]},{$buildings['Marchand'][0]},1000);");
    
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Argent'][0]},{$buildings['Tableau de mission'][0]},10000);");
    $db->query("insert into BuildingCost (ResId, BuildingId, BCAmount) values({$ressources['Influence'][0]},{$buildings['Tableau de mission'][0]},10000);");
    echo "<span class='label label-success'>DONE</span></p>";
    
    
    echo "<p>Creating Artefact costs";
    $db->query("insert into ArtefactCost (ResId, ArtefactId, ACAmount) values({$ressources['Argent'][0]},{$artefacts['Potion de soin 1'][0]},10);");
    
    $db->query("insert into ArtefactCost (ResId, ArtefactId, ACAmount) values({$ressources['Argent'][0]},{$artefacts['Potion de soin 2'][0]},90);");
    
    $db->query("insert into ArtefactCost (ResId, ArtefactId, ACAmount) values({$ressources['Argent'][0]},{$artefacts['Potion de soin 3'][0]},150);");
    
    $db->query("insert into ArtefactCost (ResId, ArtefactId, ACAmount) values({$ressources['Argent'][0]},{$artefacts['Potion de soin 4'][0]},500);");
    
    $db->query("insert into ArtefactCost (ResId, ArtefactId, ACAmount) values({$ressources['Argent'][0]},{$artefacts['Gemme de pouvoir'][0]},10000);");
    echo "<span class='label label-success'>DONE</span></p>";



    echo "<p>Finished</p>";
} catch (PDOException $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
    $PDO->rollBack();
} catch (Exception $e) {
    echo '<p>Erreur : ' . $e->getMessage() . '</p>';
}
$timeend = microtime(true);
$time = $timeend - $timestart;

$page_load_time = number_format($time, 3);
echo "Starting script at: " . date("H:i:s", $timestart);
echo "<br>Finish script at: " . date("H:i:s", $timeend);
echo "<br>Script executed in " . $page_load_time . " sec";