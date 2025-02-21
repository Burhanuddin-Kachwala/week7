<?php

use core\App;
use core\Database;
use core\Validator;

$db = App::resolve(Database::class);



$db->query(
    'update expenses 
        set amount = :amount, 
        category_id= :category_id,
        description= :description,
        date= :date 
            where id = :id', 
    [
    'id' => $_POST['id'],
    'amount' => (float)$_POST['amount'],
    'category_id' => $_POST['category'],
    'description' => $_POST['description'],
    'date' => $_POST['date']
    
    
]);

// Redirect the user
header('location: /dashboard');
die();