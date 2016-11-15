<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\core\Library as Lib;

if( !class_exists( "Project" ) ):

    class Project extends Eloquent
    {
        protected $fillable = ['user_id', 'name', 'description', 'type'];
        protected $capsule;
        protected $userID;
        protected $project_settings;

        public function __construct()
        {
            parent::__construct();
            $this->capsule = unserialize( CAPSULE );
            $this->userID  = Lib::get_current_user_id();
        }

        public function get_project( $data )
        {
            return( $this->capsule->table('projects')->where('id', $data)->first() );
        }

        public function get_all_projects_public()
        {
            $type = 2;
            return( $this->capsule->table('projects')->where('type', '=', $type)->get() );
        }

        public function add( $data = [] )
        {
            $name        = ( $data['name'] ? $data['name'] : "" );
            $description = ( $data['description'] ? $data['description'] : "" );
            $type        = ( $data['status'] ? $data['status'] : 0 );
            $type        = (int) $type;

            if( !empty( $name ) && !empty( $description ) && !empty( $type ) ):

                /** Check if project name exists */
                $projectExists  = $this->project_name_exists( $name );

                if( !$projectExists ):
                    $lastInsertId = $this->capsule->table('projects')->insertGetId([
                        'user_id'     => $this->userID,
                        'name'        => $name,
                        'description' => $description,
                        'type'        => $type
                    ]);

                    /** Create a directory for the documents and the projects */
                    $documents = Lib::path( FILE_PATH . 'documents' );
                    $projects  = Lib::path( FILE_PATH . 'documents/projects' );

                    if( !file_exists( $documents ) ): mkdir($documents, 0777, true); endif;
                    if( !file_exists( $projects ) ): mkdir($projects, 0777, true); endif;

                    /** Create a directory for the last created project */
                    $path = Lib::path( FILE_PATH . 'documents/projects/' . $lastInsertId );
                    if(!file_exists($path)): mkdir($path, 0744); endif;
                    Lib::redirect('projects/index');
                else:
                    Lib::redirect('projects/exists');
                endif;
            else:
                Lib::redirect('projects/emptyFields');
            endif;
        }

        public function project_name_exists( $name )
        {
            $exists = $this->capsule->table('projects')->where('name', '=', $name)->first();
            if( empty( $exists ) ):
                return( false );
            else:
                return( true );
            endif;
        }
    }

endif;