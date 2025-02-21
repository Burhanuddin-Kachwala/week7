<?php

use core\App;
use core\Database;
$db = App::resolve(Database::class);
$currentUserId = 4;
$results = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrAbort();
authorize($results['user_id'] == $currentUserId);
views("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'results' => $results    
]);
?>