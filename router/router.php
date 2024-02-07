<?php

class router {
    private static $instance = null;
    private function __construct() {

    }
    public function instance() {
        if(self::$instance === null) {
            self::$instance = new router();
        }

        return self::$instance;
    }

    

}