<?php
 
namespace Models; 
use Illuminate\Database\Capsule\Manager as Capsule;
 
class Database {
 
    function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => DB_DRIVER,
            'host' => '127.0.0.1',
            'database' => 'nic_website',
            'username' => 'effort',
            'password' => 'devastator',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        // Setup the Eloquent ORM… 
        $capsule->bootEloquent();
    }
 
}