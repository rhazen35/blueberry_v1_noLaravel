<?php
/**
 * Created by PhpStorm.
 * User: Ruben Hazenbosch
 * Date: 01-Aug-16
 * Time: 17:38
 */

namespace app\core;


class Library
{
    public static function path($sPath, $sDelimiter = '/', $sReplacementDelimiter = DIRECTORY_SEPARATOR)
    {
        return str_replace($sDelimiter, $sReplacementDelimiter, $sPath);
    }
}