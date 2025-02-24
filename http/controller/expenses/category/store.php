<?php
use core\App;
use core\Database;
$errors = [];
$db = App::resolve(Database::class);

$categoryName = $_POST['categoryName'];

// Check if the category already exists
$existingCategory = $db->query('SELECT * FROM expense_groups WHERE name = :categoryName', [
    'categoryName' => $categoryName
])->find();

if ($existingCategory) {
    $errors[] = 'Category already exists.';
    $_SESSION['_flash'] = $errors;
    
    header('Location: /dashboard');
    exit();
}

if (empty($errors)) {
    $db->query('INSERT INTO expense_groups (name) VALUES (:categoryName)', [
        'categoryName' => $categoryName       
    ]);
    header('Location: /dashboard');
    exit();
}
