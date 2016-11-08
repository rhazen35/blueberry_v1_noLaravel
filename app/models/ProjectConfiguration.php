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
            $projectID        = ( isset( $data ) ? $data : "" );
            $version          = "0.0.0.1";
            $branch           = "master";
            $end_user_type    = 1;
            $hash             = "";

            $configuration_id = $this->capsule->table('project_configuration')->insertGetId([
                "user_id"       => $this->userID,
                "project_id"    => $projectID,
                "hash"          => $hash,
                "end_user_type" => $end_user_type,
            ]);

            $this->capsule->table('project_configuration_version')->insert([
                "user_id"          => $this->userID,
                "project_id"       => $projectID,
                "configuration_id" => $configuration_id,
                "version"          => $version,
                "branch"           => $branch
            ]);

        }
    }

endif;