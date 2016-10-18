<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Login" ) ):

    class Login extends Controller
    {
        protected $login;

        public function __construct()
        {
            $this->login = $this->model('Login');
        }

        public function index()
        {
            $this->view('home/index', []);
        }

        public function is_logged_in()
        {
            return( isset( $_SESSION['login'] ) && !empty( $_SESSION['login'] ) ? true : false );
        }

        public function authorize()
        {
            $email    = ( !empty( $_POST['email'] ) ? trim( $_POST['email'] ) : "" );
            $password = ( !empty( $_POST['password'] ) ? trim( $_POST['password'] ) : "" );

            if( !empty( $email ) && !empty( $password ) ):
                $data = $this->login->read_where_email(['email' => $email]);
                if( $this->verify( $data, $password ) ):
                    foreach( $data as $item ):
                        $_SESSION['login'] = $item->id;
                    endforeach;
                    $this->redirect("/home");
                else:
                    $this->redirect("/login/failed");
                endif;
            else:
                return( false );
            endif;
        }

        private function verify( $data, $password )
        {
            if( !empty( $data ) ):
                foreach( $data as $item ):
                    if( !empty( $item->hash ) ):
                        $verify = !empty( $item->hash ) ? password_verify( $password, $item->hash ) : "";
                        return( $verify );
                    else:
                        return( false );
                    endif;
                endforeach;
            else:
                return( false );
            endif;
        }

        public function failed()
        {
            $this->index();
            $this->view_messages('login/failed', []);
        }

        public function logout()
        {
            unset( $_SESSION['login'] );
            $this->redirect("/home");
        }

    }

endif;