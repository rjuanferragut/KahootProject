<?php

    function randomID(){

        $num = rand(1,100000);

        return $num;
    }


    function randomPin(){

        $digits = 5;
        $pin = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

        return $pin;
    }

?>