<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "app\\controllers\\Home" ) ):

    class Home extends Controller
    {
        public function index()
        {
            $this->view('home/index', []);
        }

    }

endif;