<?php

namespace app\controllers;

use app\core\Controller;

if( !class_exists( "Users" ) ):

    class Users extends Controller
    {
        protected $user;

        public function __construct()
        {

        }

        public function index()
        {
            $this->view('common/header', []);
            $this->view('users/index', []);
            $this->view('common/footer', []);
        }

    }

endif;