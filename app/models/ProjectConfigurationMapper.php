<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\core\Library as Lib;

if( !class_exists( "ProjectConfigurationMapper" ) ):

    class ProjectConfigurationMapper extends Eloquent
    {
        protected $capsule;

        public function __construct()
        {
            parent::__construct();
            $this->capsule = unserialize( CAPSULE );
        }

        public function create_map( $data )
        {
            $configurations = $this->capsule->table('project_configuration')
                                            ->join('project_configuration_version', 'project_configuration.project_id', '=', 'project_configuration_version.project_id')
                                            ->select(['project_configuration.*', 'project_configuration_version.version'])
                                            ->groupby('project_configuration_version.version')
                                            ->where('project_configuration.project_id', '=', $data)
                                            ->get();

            $map     = array();
            $results = 0;
            foreach( $configurations as $configuration ):
                $map[$results]['id']            = $configuration->id;
                $map[$results]['user_id']       = $configuration->user_id;
                $map[$results]['project_id']    = $configuration->project_id;
                $map[$results]['hash']          = $configuration->hash;
                $map[$results]['version']       = $configuration->version;
                $map[$results]['end_user_type'] = $configuration->end_user_type;
                $map[$results]['created_at']    = $configuration->created_at;

                $results++;
            endforeach;

            return($map);
        }


    }

endif;