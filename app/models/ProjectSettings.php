<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\core\Library as Lib;

if( !class_exists( "ProjectSettings" ) ):

    class ProjectSettings extends Eloquent
    {
        protected $fillable = ['user_id', 'project_id', 'type'];
        protected $capsule;
        protected $userID;

        public function __construct()
        {
            parent::__construct();
            $this->capsule = unserialize( CAPSULE );
            $this->userID  = Lib::get_current_user_id();
        }

        public function add( $data = [] )
        {
            $this->capsule->table('projects_settings')->insert([
                'user_id' => $this->userID,
                'project_id' => $data
            ]);
        }

    }

endif;