<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\core\Library as Lib;

if( !class_exists( "ProjectConfigurationMapper" ) ):

    class ProjectConfigurationMapper extends Eloquent
    {
        protected $project_configuration;

        public function __construct()
        {
            parent::__construct();
            $this->project_configuration = new ProjectConfiguration();
        }

        public function create_map( $data )
        {
            return($data);
        }


    }

endif;