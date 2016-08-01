<?php
/**
 * Created by PhpStorm.
 * User: Ruben Hazenbosch
 * Date: 01-Aug-16
 * Time: 11:11
 */

namespace web\index;

$path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."blueberry".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."bootstrap".DIRECTORY_SEPARATOR."bootstrap.php";
require $path;

use app\classes\header\Header;

( new Header( "standard" ) )->request();


