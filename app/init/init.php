<?php
/**
 * Created by PhpStorm.
 * User: Ruben Hazenbosch
 * Date: 01-Aug-16
 * Time: 11:10
 */

define("ROOT_DIRECTORY", $_SERVER['DOCUMENT_ROOT']);
define("APP_DIR", "blueberry");

//set_include_path(ROOT_DIRECTORY . DIRECTORY_SEPARATOR . APP_DIR . DIRECTORY_SEPARATOR . "classes");
spl_autoload_extensions(".php");
spl_autoload_register();

var_dump(new header\Header);