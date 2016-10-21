<?php

namespace app\core;

use app\core\Library as Lib;

if( !class_exists( "app\\core\\Application" ) ):

    class Application
    {
        protected $controller = "home";
        protected $method     = 'index';
        protected $params     = [];

        public function __construct()
        {

            define( "CAPSULE", serialize( $GLOBALS['capsule'] ) );

            $url = $this->parseUrl();

            if( file_exists( Lib::path('app/controllers/' . $url[0] . '.php' ) ) )
            {
                $this->controller = $url[0];
                unset($url[0]);
            }

            require_once( Lib::path( 'app/controllers/' . $this->controller . '.php' ) );

            $cp_controller = ucfirst( $this->controller );
            $ns_controller = "\\app\\controllers\\".$cp_controller;

            $this->controller = ( new $ns_controller );

            if( isset( $url[1] ) )
            {
                if( method_exists( $this->controller, $url[1] ) )
                {
                    $this->method = $url[1];
                    unset( $url[1] );
                }
            }

            $this->params = $url ? array_values( $url ) : [];

            call_user_func_array( [$this->controller, $this->method], $this->params );
        }

        private function parseUrl()
        {
            if( isset( $_GET['url'] ) )
            {
                $url = explode('/', filter_var( rtrim( $_GET['url'], '/' ), FILTER_SANITIZE_URL ) );
                return( $url );
            }
        }
    }

endif;