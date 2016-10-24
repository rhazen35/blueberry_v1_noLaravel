<?php

namespace app\core;

use app\core\Library as Lib;
use app\controllers\Login;

if( !class_exists( "Controller" ) ):

    class Controller
    {
        protected function model( $model )
        {
            require_once( Lib::path("app/models/" . $model . ".php" ) );
            return( new $model );
        }

        protected function view( $view, $data = [] )
        {
            if( ! Login::is_logged_in() )
            {
                $view = "login/index";
            }

            require_once( Lib::path("app/views/common/header.phtml" ) );
            require_once( Lib::path("app/views/" . $view . ".phtml" ) );
            require_once( Lib::path("app/views/common/footer.phtml" ) );
        }

        protected function view_partial( $view, $partial )
        {
            require_once( Lib::path("app/views/" . $view . "/partials/" . $partial . ".phtml" ) );
        }

        protected function view_messages( $view, $data = [] )
        {
            require_once( Lib::path("app/views/messages/" . $view . ".phtml" ) );
        }

        protected function is_admin_or_super_user()
        {
            if( isset( $_SESSION['login'] ) ):
                $data = ['user_id' => $_SESSION['login']];
                $userType = (int) $this->model('User')->get_user_type($data);
                if( $userType === 1 || $userType === 2 ):
                    return( true );
                else:
                    return( false );
                endif;
            else:
                return( false );
            endif;
        }

        public function redirect( $location = '' )
        {
            header("Location: " . $location . "");
            exit();
        }

    }

endif;