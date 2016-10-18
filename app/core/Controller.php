<?php

namespace app\core;

use app\controllers\Login;

if( !class_exists( "Controller" ) ):

    class Controller
    {
        protected function model( $model )
        {
            require_once( "app/models/" . $model . ".php" );
            return( new $model );
        }

        protected function view( $view, $data = [] )
        {
            if( !( new Login() )->is_logged_in() )
            {
                $view = "login/index";
            }

            require_once( "app/views/common/header.phtml" );
            require_once( "app/views/" . $view . ".phtml" );
            require_once( "app/views/common/footer.phtml" );
        }

        protected function view_messages( $view, $data = [] )
        {
            require_once( "app/views/messages/" . $view . ".phtml" );
        }

        protected function is_admin_or_super_user()
        {
            if( isset( $_SESSION['login'] ) ):
                $data = ['user_id' => $_SESSION['login']];
                $userType = $this->model('User')->get_user_type($data);
                if( $userType === "1" || $userType === "2" ):
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