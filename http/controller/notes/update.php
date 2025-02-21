<?php

use core\App;
use core\Database;
use core\Validator;

$db = App::resolve(Database::class);
$currentUserId = 4;

// Find the corresponding note
$results = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrAbort();

// Authorize that the current user can edit the note
authorize($results['user_id'] == $currentUserId);

// Validate the form
$errors = [];
if (!Validator::string($_POST['notesbody'], 1, 255)) {
    $errors['body'] = 'A body of no more than 255 characters is required.';
}

// If no validation errors, update the record in the notes database table
if (count($errors)) {
    return views('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $results
    ]);
}

$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['notesbody']
]);

// Redirect the user
header('location: /notes');
die();