<?php


use core\App;
use core\Database;

$db = App::resolve(Database::class);

$results = $db->query("SELECT e.*, c.name AS category 
        FROM expenses e 
        JOIN expense_groups c ON e.category_id = c.id")->findOrAbort();

// Render the expenses again
echo json_encode([
    'status' => 'success',
    'months' => groupExpensesByMonth($results)
]);
?>