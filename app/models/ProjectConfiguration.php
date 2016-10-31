<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\core\Library as Lib;

if( !class_exists( "ProjectConfiguration" ) ):

    class ProjectConfiguration extends Eloquent
    {
        protected $fillable = [];
        protected $capsule;
        protected $userID;
        protected $mapper;

        public function __construct()
        {
            parent::__construct();
            $this->capsule = unserialize( CAPSULE );
            $this->userID  = Lib::get_current_user_id();
            $this->mapper  = ( new ProjectConfigurationMapper() )->create_map( $data = [] );
        }

        public function get_project_configurations( $data )
        {
            return( $this->capsule->table('project_configuration')->where('project_id', '=', $data)->get() );
        }

        public function get_project_configurations_versions( $data )
        {
            return( $this->capsule->table('project_configuration_version')->where('project_id', '=', $data)->get() );
        }

        public function new_configuration( $data )
        {
            $map = $this->mapper->create_map( $data );
            var_dump($map);
        }
    }

endif;