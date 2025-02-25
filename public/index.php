<?php

session_start();


const BASE_PATH = __DIR__.'/../';
require BASE_PATH.'vendor/autoload.php';
require(BASE_PATH.'core/functions.php');

require base_path('core/Database.php');
// spl_autoload_register(function($class){
//    $class=str_replace('\\',DIRECTORY_SEPARATOR,$class); 
  
//   require base_path($class . '.php');
// });
require base_path('bootstrap.php');
require base_path('core/session.php');

$router =new core\Router();
$routes = require base_path('core/routes.php');
$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router->route($url,$method);
core\Session::unflash();

?>
