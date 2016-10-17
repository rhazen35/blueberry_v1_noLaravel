<?php

namespace app\core;

if( !class_exists( "Router" ) ):

    class Router
    {
        protected $type;

        public function __construct( $type )
        {
            $this->type = $type;
        }

        public function request( $params )
        {
            switch( $this->type ):
                case"getCurrentUri":
                    return( $this->getCurrentUri() );
                    break;
                case"getCurrentRoute":
                    return( $this->getCurrentRoute() );
                    break;
            endswitch;
        }

        private function getCurrentUri()
        {
            $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
            $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
            if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
            $uri = '/' . trim($uri, '/');
            return $uri;
        }

        private function getCurrentRoute()
        {
            $base_url = $this->getCurrentUri();
            $routes = array();
            $routes = explode('/', $base_url);
            foreach($routes as $route)
            {
                if(trim($route) != '')
                    array_push($routes, $route);
            }
            return($routes);
        }
    }

endif;