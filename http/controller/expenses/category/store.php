<?php
use core\App;
use core\Database;
// Ensure that no previous output is sent



$errors = [];
$db = App::resolve(Database::class);

$categoryName = trim($_POST['categoryName']);

// Check if the category already exists
$existingCategory = $db->query('SELECT * FROM expense_groups WHERE name = :categoryName', [
    'categoryName' => $categoryName
])->find();

if ($existingCategory) {
    $errors['category'] = 'Category already exists.';
}
header('Content-Type: application/json');
if (empty($errors)) {
    
    $db->query('INSERT INTO expense_groups (name) VALUES (:categoryName)', [
        'categoryName' => $categoryName       
    ]);
    
    
   
    echo json_encode(['status' => 'success', 'message' => 'Category added successfully']);
   
}
else{
    echo json_encode(['status' => 'error', 'message' => 'Category already exists']);
}

exit;
