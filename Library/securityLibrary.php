<?php

namespace Library;

class securityLibrary {

    public function checkUsername(&$value) {
        $value = preg_replace("/[^A-Za-z0-9-éàèÉÈÀ]/", "", $value, -1, $count);
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkPassword(&$value) {
        $value = preg_replace("/[^A-Za-z0-9.*+*@*_*-*]/", "", $value, -1, $count);
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function encrypt($email, $password) {
        $password = sha1(strtoupper($email) . ":" . strtoupper($password));
        $password = strtoupper($password);

        return $password;
    }


    public function strip($value) {
        $value = stripslashes(htmlspecialchars($value));
        return $value;
    }


    public function checkEmail($link) {
        if ($link != "") {
            if (filter_var($link, FILTER_VALIDATE_EMAIL)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

}

?>
