<?php

namespace Library;


class generalLibrary {

    public function countArray($array) {
        $count = 0;
        foreach ($array as $error) {
            if (!empty($error)) {
                $count++;
            }
        }
        return $count;
    }



}

?>
