<?php

namespace Web\Module;

use Library\securityLibrary;
use Web\Entity\mageEntity;
use Library\generalLibrary;

class mageModule {

    public function register() {
        $account = new mageEntity();
        $security = new securityLibrary();
        $general = new generalLibrary();

        $array = array("error" => array("pseudo" => "", "password" => "", "confirm" => "", "email" => "", "mageType" => ""));

        if (isset($_POST['register'])) {
            $pseudo = $_POST['pseudo'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $email = $_POST['email'];
            $mageType = $_POST['mageType'];

            if (!empty($pseudo)) {
                if ($security->checkUsername($pseudo)) {
                    if (strlen($pseudo) < 20 && strlen($pseudo) > 3) {
                        if (count($account->getAccount($pseudo)) > 0) {
                            $array['error']['pseudo'] = "Ce login est déja utilisé";
                        }
                    } else {
                        $array['error']['pseudo'] = "La longueur du login doit etre entre 3 et 20";;
                    }
                } else {
                    $array['error']['pseudo'] = "Login invalide";
                }
            } else {
                $array['error']['pseudo'] = "Merci de préciser un login";
            }

            if (!empty($password)) {
                if ($security->checkPassword($password)) {
                    if (strlen($password) < 6) {
                        $array['error']['password'] = "Le mot de passe doit contenir au moins 6 caractères";
                    }
                } else {
                    $array['error']['password'] = "Erreur 2";
                }
            } else {
                $array['error']['password'] = "Mot de passe obligatoire";
            }

            if ($password != $confirm) {
                $array['error']['confirm'] = "La cofirmation du mot de passe est erronée";
            }

            if (!empty($email)) {
                if ($security->checkEmail($email) == false) {
                    $array['error']['email'] = "L'adresse mail n'est pas valide";
                }
            } else {
                $array['error']['email'] = "Merci de préciser une adresse mail";
            }

            if ($general->countArray($array['error']) == 0) {
                $password = $security->encrypt($pseudo, $password);
                $account->newAccount($pseudo, $password, $email, $mageType);
                header('Location: index.php?pages=login');
                exit;
            }
        }

        return $array;
    }

    public function login() {
        $account = new mageEntity();
        $security = new securityLibrary();

        $array = array("error" => "", "post" => "");

        if (isset($_POST['login'])) {
            $password = $_POST['password'];
            $pseudo = $_POST['pseudo'];

            $getAccount = $account->getAccount($pseudo);

            if (count($getAccount) > 0) {
                $password = $security->encrypt($pseudo, $password);
                if ($password == $getAccount['0']['MagePwd']) {
                    $_SESSION['login'] = $pseudo;
                    header('location: index.php?pages=overview');
                    exit;
                }
            }

            $array['post'] = $pseudo;
            $array['error'] = "Utilisateur ou mot de passe incorrect";
        }

        return $array;
    }
    
    public function logout(){
        session_destroy();
        unset($_SESSION['login']);
        session_start();
        header('location: index.php?pages=index');
        exit();
    }

    public function getAllType(){

    }

}
