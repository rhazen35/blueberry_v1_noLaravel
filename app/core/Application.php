<?php

namespace app\core;

use app\core\Library as Lib;
use app\core\Router;

if( !class_exists( "Application" ) ):

    class Application
    {

        public function launch()
        {
            if( $_SERVER['REQUEST_METHOD'] === "POST"):
                require( $this->loadHandler() );
            else:
                return( $this->loadApp() );
            endif;
        }
        /**
         * @return string
         */
        private function loadApp()
        {
            return( ( new Router( "getCurrentRoute" ) )->request( $params = null ) );
        }
        /**
         * @return string
         */
        private function loadHandler()
        {
            $prefix = "app". DIRECTORY_SEPARATOR ."handlers". DIRECTORY_SEPARATOR;
            $path   = (isset($_POST['path']) ? $_POST['path'] : "");
            $attr   = (isset($_POST['attr']) ? $_POST['attr'] : "");
            $ext    = ".php";

            return( Lib::path( $prefix.$path.DIRECTORY_SEPARATOR.$attr.$ext ) );
        }
    }

endif;