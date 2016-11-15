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
                    $parts       = explode( ".", $item['version'] );
                    $total_parts = count( $parts );

                    if( $total_parts === 4 ): /** Status is validate */
                        $version = "0.0.0." . ( $parts[3] + 1 );
                    elseif( $total_parts === 3 ): /** Status is testing */
                        $version = "0.0." . ( $parts[2] + 1 );
                    elseif( $total_parts === 2 ): /** Status is acceptation */
                        $version = "0." . ( $parts[1] + 1 );
                    elseif( $total_parts === 1 ): /** Status is production */
                        $version = "" . ( $parts[0] + 1 );
                    endif;

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

            Lib::redirect('projects/configurations/' . $data . '');

        }

        public function new_branch( $params, $map )
        {
            foreach( $map as $item ):
                if( (int) $item['id'] === (int) $params['configurationID'] ):
                    $hash          = $item['hash'];
                    $end_user_type = $item['end_user_type'];
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
                        "version"          => $version,
                        "branch"           => $params['branch']
                    ]);

                    break;
                endif;
            endforeach;

            Lib::redirect('projects/configurations/' . $data . '');

        }
    }

endif;