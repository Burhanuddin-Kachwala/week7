<?php

use core\App;
use core\Database;

header('Content-Type: application/json');

$db = App::resolve(Database::class);


    $id = $_POST['id'] ?? null;

    if ($id) {
        $db->query('DELETE FROM expenses WHERE id = :id', [
            'id' => $id
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Expense deleted successfully']);
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        exit();
    }
   
