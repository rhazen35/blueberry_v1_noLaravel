<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Library as Lib;

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

        public function get_project( $data )
        {
            return( $this->project->get_project( $data ) );
        }

        public function configurations( $data )
        {
            $this->view('projects/configurations', $data);
        }

        public function project_settings()
        {
            $this->view('projects/settings', []);
        }

        public function get_configuration_map( $data )
        {
            return ( $this->configuration_mapper->create_map( $data ) );
        }

        public function new_configuration( $data = [] )
        {
            $map = $this->get_configuration_map( $data );
            $this->configuration->new_configuration( $data, $map );
        }

        public function new_branch()
        {
            $params = array();
            $params['projectID']       = !empty( $_POST['projectID'] ) ? $_POST['projectID'] : "";
            $params['configurationID'] = !empty( $_POST['configurationID'] ) ? $_POST['configurationID'] : "";
            $params['branch']          = !empty( $_POST['branch'] ) ? $_POST['branch'] : "";

            $map = $this->get_configuration_map( $params['projectID'] );
            $this->configuration->new_branch( $params, $map );
        }

        public function get_all_projects_public()
        {
            return( $this->project->get_all_projects_public() );
        }

        public function get_project_configurations( $data = [] )
        {
            return( $this->configuration_mapper->create_map( $data ) );
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