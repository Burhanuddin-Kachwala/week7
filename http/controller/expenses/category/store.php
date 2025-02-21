<?php
use core\App;
use core\Database;
$errors = [];
$db = App::resolve(Database::class);
if (empty($errors)) {
    $db->query('INSERT INTO expense_groups (name) VALUES (:categoryName)', [
        'categoryName' => $_POST['categoryName']       
    ]);

    
}
header('Location: /dashboard');
    
    exit();
