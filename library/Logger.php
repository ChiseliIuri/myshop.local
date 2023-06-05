<?php
class Logger {
    function debug($value = null, $die = 1){
        echo'Debug: <br/><pre>';
        print_r($value);
        echo'</pre>';
        if($die) die;
    }
}