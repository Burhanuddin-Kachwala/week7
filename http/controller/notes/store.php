<?php

use core\App;
use core\Database;
$errors = [];

if (!isset($_POST['notesbody']) || strlen(trim($_POST['notesbody'])) === 0) {
    $errors['body'] = 'The notes body is required';
}
if (strlen($_POST['notesbody']) > 255) {
    $errors['body'] = 'The notes body must be less than 255 characters';
}
if(!empty($errors)){
    views(
        'notes/create.view.php',
        [
            'heading' => 'Create Note',
            'errors' => $errors
        ]
    );
    return;
}
$currentUserId = 4;
$db = App::resolve(Database::class);
if (empty($errors)) {
    $db->query('INSERT INTO notes (body,user_id) VALUES (:body,:user_id)', [
        'body' => $_POST['notesbody'],
        'user_id' => $currentUserId
    ]);
    header('Location:/notes');
    exit();
}
