<?php

session_start();

use app\core\Library as Lib;
use app\core\Configuration;
use app\core\Application;

require_once( 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );
require_once( 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php' );
require_once( 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Library.php' );
require_once( 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Controller.php' );

define( 'APPLICATION_PATH', realpath( Lib::path(__DIR__) ) . DIRECTORY_SEPARATOR );

require_once( APPLICATION_PATH . Lib::path( 'app/core/autoloader.php' ) );
require_once( APPLICATION_PATH . Lib::path( 'app/core/glossary.php' ) );

( new Configuration() )->initSet();
( new Application() );