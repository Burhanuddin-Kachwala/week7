<?php

use core\App;
use core\Database;
$errors = [];

// // Validate the notes body
// $notesBody = $_POST['notesbody'] ?? '';
// if (strlen(trim($notesBody)) === 0) {
//     $errors['body'] = 'The notes body is required';
// }
// if (strlen($notesBody) > 255) {
//     $errors['body'] = 'The notes body must be less than 255 characters';
// }

// // If there are errors, show the create view with errors
// if (!empty($errors)) {
//     views(
//         'notes/create.view.php',
//         [
//             'heading' => 'Create Note',
//             'errors' => $errors
//         ]
//     );
//     return;
// }

// $currentUserId = 4;
$db = App::resolve(Database::class);

// Insert into the expenses table
$amount = $_POST['amount'] ?? 0;
$categoryId = $_POST['category'] ?? 12;//currently hardcoded
$description = $_POST['description'] ?? '';
$date = $_POST['date'];

if (empty($errors)) {
    $db->query('INSERT INTO expenses (amount, category_id, description, date) VALUES (:amount, :category_id, :description, :date)', [
        'amount' => $amount,
        'category_id' => $categoryId,
        'description' => $description,
        'date' => $date
    ]);
    header('Location:/dashboard');
    exit();
}
