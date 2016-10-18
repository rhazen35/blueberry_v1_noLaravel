<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Users" ) ):

    class Users extends Controller
    {
        protected $user;

        public function __construct()
        {

        }

        public function index()
        {
            ( $this->is_admin_or_super_user() ? $this->view('users/index', []) : $this->view('home/index', []) );
        }

        public function get_users()
        {
            $data = $this->model('User')->get_users();
            return( $data );
        }

        public function convert_user_type( $user_type )
        {
            switch( $user_type ):
                case"1":
                    return( "admin" );
                    break;
                case"2":
                    return( "superuser" );
                    break;
                case"3":
                    return( "normal" );
                    break;
                case"4":
                    return( "guest" );
                    break;
                default:
                    return( "unknown" );
                    break;
            endswitch;
        }

    }

endif;