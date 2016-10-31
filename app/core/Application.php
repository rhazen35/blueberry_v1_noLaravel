<?php

namespace app\core;

if( !class_exists( "Application" ) ):

    class Application
    {
        /**
         * Application constructor.
         */
        public function __construct()
        {
            /** Globalize capsule (Laravel / Eloquent) and set the route */
            define( "CAPSULE", serialize( $GLOBALS['capsule'] ) );
            ( new Router() )->set_route();
        }
    }

endif;