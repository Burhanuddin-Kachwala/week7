<?php

use core\App;
use core\Database;
$errors = [];

$db = App::resolve(Database::class);

    $category=$db->query('select * from expense_groups')->find();
    views('expenses/home.view.php',[
        'category'=>$category
    ]);
    
    




