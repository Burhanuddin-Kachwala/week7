<?php
use http\Forms\ExpenseForm;
use core\App;
use core\Database;
$errors = [];



$db = App::resolve(Database::class);

// Insert into the expenses table
$amount = $_POST['amount'] ?? 0;
$categoryId = $_POST['category'] ?? 12;//currently hardcoded
$description = $_POST['description'] ?? '';
$date = $_POST['date'];
$form = new ExpenseForm();

if (!$form->validate($amount, $categoryId, $description, $date)) {
    
    $errors = $form->errors();
    views(
        'expenses/dashboard.view.php',
        [      
            'results' => [],
            'category'=>[],            
            'errors' => $form->errors()
        ]
    );
    return;
    exit();
}

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
