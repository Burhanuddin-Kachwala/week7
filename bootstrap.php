<?php
use core\Container;
use core\App;
use core\Database;

$container = new Container();
$container->bind(Database::class, function(){
    return new Database();
});
$db = $container->resolve(Database::class);
App::setContainer($container);