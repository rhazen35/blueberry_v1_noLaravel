<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

if( !class_exists( "User" ) ):

    class User extends Eloquent
    {
        public function get_user_type( $data = '' )
        {
            $capsule = unserialize( CAPSULE );
            $data    = $capsule->table('users_type')->where('user_id', '=', $data['user_id'])->get();

            if( !empty( $data ) ):
                foreach( $data as $item ):
                    if( !empty( $item->type ) ):
                        return( $item->type );
                    else:
                        return( false );
                    endif;
                endforeach;
            else:
                return( false );
            endif;

            return( false );
        }

        public function get_users()
        {
            $capsule = unserialize( CAPSULE );
            $data    = $capsule->table('users')->get();
            return($data);
        }
    }

endif;