<?php

namespace Web\Controller;

use Library\parserLibrary;

class defaultController {

    var $data = array();

    public function indexAction() {
        $this->controllerAction();
        $parser = new parserLibrary;
        $file = $parser->logged(file_get_contents("./Resources/views/default.html"));
        return $parser->parse($file, $this->data);
    }

    public function controllerAction() {
        if (isset($_GET['pages'])) {
            $controller = './Controller/' . $_GET['pages'] . 'Controller.php';
            if (file_exists($controller)) {
                $class = 'Web\Controller\\' . $_GET['pages'] . 'Controller';
                $page = $_GET['pages'];
            } else {
                $class = 'Web\Controller\notFoundController';
                $page = 'Erreur 404';
            }
        } else {
            $class = 'Web\Controller\indexController';
            $page = 'Accueil';
        }
        
        $this->data["page"] = $page;
        $class = new $class;
        
        $this->data["pages"] = $class->indexAction();
    }

}
