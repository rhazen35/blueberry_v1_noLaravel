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
                case"":

                    break;
            endswitch;
        }


    }

endif;