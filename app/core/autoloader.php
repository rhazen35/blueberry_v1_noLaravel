<?php

/**
 * Created by PhpStorm.
 * User: Ruben Hazenbosch
 * Date: 01-Aug-16
 * Time: 17:31
 */

spl_autoload_register(function ($class) {
    $path = APPLICATION_PATH . \app\core\Library::path($class . '.php', '\\');
    if (is_file($path)) {
        require_once($path);
        return true;
    }
    return false;
}, false);