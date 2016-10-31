<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Projects" ) ):

    class Projects extends Controller
    {
        protected $project;
        protected $settings;
        protected $configuration;
        protected $configuration_mapper;

        public function __construct()
        {
            $this->project              = $this->model("Project");
            $this->settings             = $this->model("ProjectSettings");
            $this->configuration        = $this->model("ProjectConfiguration");
            $this->configuration_mapper = $this->model("ProjectConfigurationMapper");
        }

        public function index( $data = [] )
        {
            $this->view('projects/index', $data);
        }

        public function new_project()
        {
            $this->view('projects/new', []);
        }

        public function new_configuration( $data = [] )
        {
            $map = $this->configuration_mapper->create_map( $data );
            $this->configuration->new_configuration( $data, $map );
        }

        public function get_all_projects_public()
        {
            return( $this->project->get_all_projects_public() );
        }

        public function add()
        {
            $this->project->add( $_POST );
        }

        public function convert_project_type( $type )
        {
            switch( (int) $type ):
                case 1:
                    return( "private" );
                break;
                case 2:
                    return( "public" );
                    break;
                default:
                    return( 1 );
                    break;
            endswitch;
        }

    }

endif;