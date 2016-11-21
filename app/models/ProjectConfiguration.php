<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\core\Library as Lib;
use app\core\traits\ProjectConfiguration as Pconfig;

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

        public function get_configuration( $data )
        {
            return( $this->capsule->table('project_configuration')->where('id', $data)->first() );
        }

        public function get_project_configurations( $data )
        {
            return( $this->capsule->table('project_configuration')->where('project_id', $data[0])->get() );
        }

        public function get_project_configurations_versions( $data )
        {
            return( $this->capsule->table('project_configuration_version')->where('project_id', $data[0])->get() );
        }

        public function new_configuration( $data, $map )
        {
            $version       = "";
            $projectID     = ( isset( $data[0] ) ? $data[0] : "" );
            $branch        = !empty( $data['branch'] ) ? $data['branch'] : "master";
            $end_user_type = 1;
            $hash          = "";

            /** Start version number */
            if( empty( $map ) ):
                $version       = "0.0.0.1";
            else:
                foreach( $map as $item ):
                    $version = Pconfig::update_version_number( $item['version'] );
                endforeach;
            endif;

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

            Lib::redirect('projects/configurations/' . $projectID . '');

        }

        public function does_branch_exists( $branch )
        {
            $get_branch = $this->capsule->table('project_configuration_version')
                                    ->select('id')
                                    ->where('branch', $branch)
                                    ->first();
            if( !empty( $get_branch ) ):
                return( true );
            else:
                return( false );
            endif;
        }

        public function new_branch( $params, $map )
        {
            $branch_exists = $this->does_branch_exists( $params['branch'] );

            if( $branch_exists === false ):
                foreach( $map as $item ):
                    if( (int) $item['id'] === (int) $params['configurationID'] ):

                        $hash          = $item['hash'];
                        $end_user_type = $item['end_user_type'];
                        $branch        = $item['branch'];
                        $version       = $item['version'];

                        $configuration_id = $this->capsule->table('project_configuration')->insertGetId([
                            "user_id"       => $this->userID,
                            "project_id"    => $params['projectID'],
                            "hash"          => $hash,
                            "end_user_type" => $end_user_type,
                        ]);

                        $this->capsule->table('project_configuration_version')->insert([
                            "user_id"          => $this->userID,
                            "project_id"       => $params['projectID'],
                            "configuration_id" => $configuration_id,
                            "version"          => Pconfig::create_version_number( $version ),
                            "branch"           => $params['branch'],
                            "parent"           => $params['configurationID']
                        ]);
                        break;
                    endif;
                endforeach;
                Lib::redirect('projects/configurations/' . $params['projectID'] . '');
            else:
                Lib::redirect('projects/configurations/' . $params['projectID'] . '/' . $params['configurationID'] . '/branchExists');
            endif;

        }

        public function get_project_branches( $projectID )
        {
            $branches = $this->capsule->table('project_configuration_version')
                                        ->where('project_id', $projectID)
                                        ->where('branch', '!=', 'master')
                                        ->get();
            return($branches);
        }
    }

endif;