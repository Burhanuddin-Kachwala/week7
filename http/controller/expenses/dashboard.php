<?php
use core\App;
use core\Database;

$db = App::resolve(Database::class);

$results =$db->query("SELECT e.*, c.name AS category 
        FROM expenses e 
        JOIN expense_groups c ON e.category_id = c.id")->findOrAbort();
       


$category=$db->query('select * from expense_groups')->find();

views(
    'expenses/dashboard.view.php', 
    [
        
        'results' => $results,
        'months' => groupExpensesByMonth($results),
        'categories'=>groupExpensesByCategory($results),
        'category'=>$category,
        'display'=>'category',
        
    ]
);


?>