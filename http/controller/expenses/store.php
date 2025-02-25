<?php
use http\Forms\ExpenseForm;
use core\App;
use core\Database;

$errors = [];
$db = App::resolve(Database::class);

// Get data from POST request
$amount = $_POST['amount'] ?? 0;
$categoryId = $_POST['category'] ?? 12; // Currently hardcoded
$description = $_POST['description'] ?? '';
$date = $_POST['date'];

// Initialize form validation
$form = new ExpenseForm();

// Check for validation errors
if (!$form->validate($amount, $categoryId, $description, $date)) {
    $errors = $form->errors();
    echo json_encode([
        'status' => 'error',
        'errors' => $errors
    ]);
    exit();
}

// If no errors, proceed with inserting data into the database
if (empty($errors)) {
    $db->query('INSERT INTO expenses (amount, category_id, description, date) VALUES (:amount, :category_id, :description, :date)', [
        'amount' => $amount,
        'category_id' => $categoryId,
        'description' => $description,
        'date' => $date
    ]);

    // Return success response
    echo json_encode([
        'status' => 'success',
        'message' => 'Expense added successfully!'
    ]);
    exit();
}
