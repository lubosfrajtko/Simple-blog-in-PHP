<?php

// show all errors
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);



//require stuff
if( !session_id() ) @session_start();
require_once 'vendor/autoload.php';

//constants

define('BASE_URL', 'http://localhost:8888/myblog' );
define('APP_PATH', realpath(__DIR__. '/../') );


// configurations
$config = [

	'db' => [
		'database_type' => 'mysql',
		'database_name' => 'myblog',
		'server'        => 'localhost',
		'name'      => 'root',
		'pass'      => 'root',
		'charset'       => 'utf8'
	]

];
// connect to db
$db = new PDO("{$config['db']['database_type']}:host={$config['db']['server']};dbname={$config['db']['database_name']};charset={$config['db']['charset']}", $config['db']['name'], $config['db']['pass']);


$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//functions 

require_once 'functions-general.php';
require_once 'functions-post.php';
require_once 'functions-string.php';
require_once 'functions-auth.php';