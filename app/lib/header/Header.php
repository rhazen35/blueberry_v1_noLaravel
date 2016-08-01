<?php
/**
 * Created by PhpStorm.
 * User: Ruben Hazenbosch
 * Date: 01-Aug-16
 * Time: 11:47
 */

namespace app\classes\header;

if( !class_exists( "Header" ) ):

    class Header
    {

        protected $header;

        public function __construct( $header )
        {
            $this->header = $header;
        }

        public function request()
        {
            echo'asdadadasdasd';
        }

        private function standardHeader()
        {
            echo '<!DOCTYPE html>';
            echo '<html>';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<meta name="keywords" content="">';
            echo '<meta name="robots" content="nofollow">';
            echo '<meta property="og:title" content="Control Management System">';
            echo '<meta property="og:type" content="website">';
            echo '<meta property="og:description" content="">';
            echo '<meta property="og:url" content="">';
            echo '<meta property="og:image" content="">';
            echo '<link href="https://fonts.googleapis.com/css?family=Raleway%7cPassion+One%7cWork+Sans%7cRoboto+Condensed:400" rel="stylesheet" type="text/css">';
            echo '<link rel="stylesheet" type="text/css" href="css/style.css">';

            echo '<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="crossorigin="anonymous"></script>';
            echo '<script type="text/javascript" src="js/functions.js"></script>';
            echo '<title>QuaRatio</title>';
            echo '</head>';
            echo '<body>';
        }

    }

endif;

