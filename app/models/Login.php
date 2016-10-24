<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

if( !class_exists( "Login" ) ):

    class Login extends Eloquent
    {
        public $timestamps = ['created_at', 'updated_at'];

        public function read_where_email( $data = '' )
        {
            $capsule = unserialize( CAPSULE );
            $read = $capsule->table('users')->where('email', '=', $data['email'])->get();
            return($read);
        }

        private function get_users_login()
        {
            $user_id = ( !empty( $_SESSION['login'] ) ? $_SESSION['login'] : "" );
            $capsule = unserialize( CAPSULE );
            $read = $capsule->table('users_login')->where('user_id', '=', $user_id)->first();
            return($read);
        }

        public function register_login()
        {
            $data = $this->get_users_login();
            return($data);
        }

        public function register_new_login()
        {
            $user_id = ( !empty( $_SESSION['login'] ) ? $_SESSION['login'] : "" );
            $date    = date( "Y-m-d" );
            $capsule = unserialize( CAPSULE );
            $capsule->table('users_login')->insert(['user_id' => $user_id, 'previous' => "", 'current' => $date, 'first' => $date, 'count' => 1]);
        }
    }

endif;