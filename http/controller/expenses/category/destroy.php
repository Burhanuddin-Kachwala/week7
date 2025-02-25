<?php

use core\App;
use core\Database;

header('Content-Type: application/json');

$db = App::resolve(Database::class);


    $name = $_POST['name'] ?? null;

    if ($name) {
        $db->query('DELETE FROM expense_groups WHERE name = :name', [
            'name' => $name
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Category']);
        exit();
    }
   
