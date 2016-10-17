<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

if( !class_exists( "User" ) ):

    class User extends Eloquent
    {
        public $name;

        public $timestamps  = ['created_at', 'updated_at'];
        protected $fillable = ['username', 'email', 'hash'];
    }

endif;