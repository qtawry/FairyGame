<?php
session_start();

function __autoload($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require_once('../' . $path . '.php');
}

use Web\Controller\defaultController;

$default = new defaultController;
echo $default->indexAction();
