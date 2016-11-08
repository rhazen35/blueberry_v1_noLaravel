<?php

namespace app\core;

if( !class_exists( "RouterMapper" ) ):

    class RouterMapper
    {
        /**
         * @return array
         */
        public static function routes()
        {
            $routes = array(
                /**
                 **** url **************************** controller *********************** method **********************
                 *
                 *
                 * Login */
                array('url' => 'login/index'                    , 'controller' => 'login'           , 'action' => 'index'),
                array('url' => 'login/logout'                   , 'controller' => 'login'           , 'action' => 'logout'),
                array('url' => 'login/authorize'                , 'controller' => 'login'           , 'action' => 'authorize'),
                array('url' => 'login/failed'                   , 'controller' => 'login'           , 'action' => 'failed'),

                /** Home */
                array('url' => 'home/index'                     , 'controller'  => 'home'           , 'action' => 'index'),

                /** Users */
                array('url' => 'users/index'                    , 'controller' => 'users'           , 'action' => 'index'),
                array('url' => 'users/new_user'                 , 'controller' => 'users'           , 'action' => 'new_user'),
                array('url' => 'users/add_user'                 , 'controller' => 'users'           , 'action' => 'add_user'),
                array('url' => 'users/delete'                   , 'controller' => 'users'           , 'action' => 'delete'),
                array('url' => 'users/edit'                     , 'controller' => 'users'           , 'action' => 'edit'),

                /** Projects */
                array('url' => 'projects/index'                 , 'controller' => 'projects'        , 'action' => 'index'),
                array('url' => 'projects/new'                   , 'controller' => 'projects'        , 'action' => 'new_project'),
                array('url' => 'projects/add'                   , 'controller' => 'projects'        , 'action' => 'add'),
                array('url' => 'projects/new-configuration'     , 'controller' => 'projects'        , 'action' => 'new_configuration'),
                array('url' => 'projects/configurations'        , 'controller' => 'projects'        , 'action' => 'configurations'),
                array('url' => 'projects/settings'              , 'controller' => 'projects'        , 'action' => 'project_settings'),

                /** Contact */
                array('url' => 'contact/index'                  , 'controller' => 'contact'         , 'action' => 'index')
            );

            return( $routes );
        }
    }

endif;