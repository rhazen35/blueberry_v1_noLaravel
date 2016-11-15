<?php

namespace app\core;

use app\core\Library as Lib;

if( !class_exists( "Router" ) ):

    class Router extends Controller
    {
        protected $url;
        protected $routes;
        protected $default_controller = "home";
        protected $default_method     = "index";
        protected $controller         = "home";
        protected $method             = 'index';
        protected $params             = [];

        /**
         * Router constructor.
         */
        public function __construct()
        {
            /**
             * Parse the url
             * @var $url
             */
            $this->url    = $this->parse_url( isset( $_GET['url'] ) ? $_GET['url'] : "" );
            $this->routes = RouterMapper::routes();
        }

        /**
         * Parse the url
         * @param $url
         * @return array|bool
         */
        private function parse_url( $url )
        {
            if( !empty( $url ) ):
                $parsed_url = explode('/', filter_var( rtrim( $url, '/' ), FILTER_SANITIZE_URL ) );
                return( $parsed_url );
            endif;

            return( false );
        }

        /**
         * Set the route, extracted from the url
         */
        public function set_route()
        {
            $url         = $this->url;
            $route       = !empty( $url[0] ) && !empty( $url[1] ) ? $url[0] . '/' . $url[1] : 'home/index';
            $route_exist = false;

            /**
             * @var  $route_item
             * Walk trough the routes array and find the correct route
             */
            foreach( $this->routes as $route_item ):
                if( in_array( $route, $route_item ) ):
                    $this->controller = $route_item['controller'];
                    $this->method     = $route_item['action'];
                    $route_exist      = true;
                    break;
                endif;
            endforeach;

            /** Check if the route exists */
            if( !$route_exist ):
                $this->view('common/404', []);
                exit();
            endif;

            /** Check if the controller exists */
            if( file_exists( Lib::path('app/controllers/' . $this->controller . '.php' ) ) ):
                require_once( Lib::path( 'app/controllers/' . $this->controller . '.php' ) );
                unset($url[0]);

                /** Capitalize first letter of controller and set controller namespace */
                $cp_controller = ucfirst( $this->controller );
                $ns_controller = "\\app\\controllers\\".$cp_controller;

                $this->controller = ( new $ns_controller );

                /** Check if the method exists */
                if( method_exists( $this->controller, $this->method ) ):
                    unset( $url[1] );
                else:
                    $this->view('common/404', []);
                    exit();
                endif;

                $this->params = $url ? array_values( $url ) : [];

                call_user_func( array( $this->controller, $this->method ), $this->params );
            else:
                $this->view('common/404', []);
                exit();
            endif;
        }
    }

endif;