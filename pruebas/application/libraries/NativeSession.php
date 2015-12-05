<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class Nativesession {
    
    public function __construct() {
        session_start();
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function regenerateId($delOld = false) {
        session_regenerate_id($delOld);
    }

    public function delete($key) {
        unset($_SESSION[$key]);
    }
    
    public function SessionDestroy(){
        session_destroy();
    }

}