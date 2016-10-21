<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "app\\controllers\\Projects" ) ):

    class Projects extends Controller
    {
        public function index()
        {
            $this->view('projects/index', []);
        }

    }

endif;