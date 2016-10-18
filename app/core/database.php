<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'username'  => 'ruben35',
    'password'  => 'Ruben1986Hazenbosch35',
    'database'  => 'blueberry',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();