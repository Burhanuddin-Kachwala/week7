<?php

use core\App;
use core\Database;


header('Content-Type: application/json');

$db = App::resolve(Database::class);

// Validate input
if (empty($_POST['old']) || empty($_POST['new'])) {
    echo json_encode(['status' => 'error', 'message' => ' name are required.']);
    exit;
}

// Check if the new name already exists
$existing = $db->query(
    'SELECT COUNT(*) as count FROM expense_groups WHERE name = :newName',
    [
        'newName' => $_POST['new']
    ]
)->find();

if ($existing['count'] > 0) {
    echo json_encode(['status' => 'error', 'message' => 'The new name already exists.']);
    exit();
}

// Update the name
$result = $db->query(
    'UPDATE expense_groups 
        SET  
        name = :newName       
        WHERE name = :old',
    [
        'old' => $_POST['old'],
        'newName' => $_POST['new']
    ]
);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Category name updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update category name.']);
}
exit(); 