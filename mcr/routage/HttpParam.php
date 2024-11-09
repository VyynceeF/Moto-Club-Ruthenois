<?php

class HttpParam{

    # Gestion des variable POST et GET
    public static function getParam($name) {
        if (isset($_GET[$name])) return $_GET[$name];
        if (isset($_POST[$name])) return $_POST[$name];
        return null;
    }
}