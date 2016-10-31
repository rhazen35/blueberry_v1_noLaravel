<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Projects" ) ):

    class Projects extends Controller
    {
        protected $project;
        protected $configuration;

        public function __construct()
        {
            $this->project       = $this->model("Project");
            $this->configuration = $this->model("ProjectConfiguration");
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
            $this->configuration->new_configuration( $data );
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