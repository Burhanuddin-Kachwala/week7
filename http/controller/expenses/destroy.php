<?php

use core\App;
use core\Database;

//require base_path('../Database.php');

$db = App::resolve(Database::class);



$db->query('delete from expenses where id = :id', [
    'id' => $_POST['id']
]);
header('Location: /dashboard');

