<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Home" ) ):

    class Home extends Controller
    {
        protected $user;

        public function __construct()
        {

        }

        public function index()
        {
            $this->view('home/index', []);
        }

    }

endif;