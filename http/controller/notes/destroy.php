<?php

use core\App;
use core\Database;

//require base_path('../Database.php');

$db = App::resolve(Database::class);



$db->query('delete from notes where id = :id', [
    'id' => $_POST['note_id']
]);
header('Location: /notes');

