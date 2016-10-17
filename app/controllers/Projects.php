<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Projects" ) ):

    class Projects extends Controller
    {


        public function __construct()
        {

        }

        public function index()
        {
            $this->view('common/header', []);
            $this->view('projects/index', []);
            $this->view('common/footer', []);
        }

    }

endif;