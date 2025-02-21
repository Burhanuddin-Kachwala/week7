<?php
use core\App;
use core\Database;
use http\Forms\LoginForm;
$errors = [];

// Use the service container to get instances of Validator and Database

$db = App::resolve(Database::class);

$data = [  
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

$form = new LoginForm();


if (!$form->validate($data['email'], $data['password'])) {

    $errors = $form->errors();
    views(
        'sessions/create.view.php',
        [
            'heading' => 'Add New User',
            'errors' => $form->errors()
        ]
    );
    return;
    exit();
}
// Check if the email already exists
$emailExists = $db->query('select * from users where email = :email', [
    'email' => $data['email']
])->find();

if ($emailExists) {
    $errors['email'] = 'Email already exists.';
}

if (empty($errors)) {
    // Hash the password before storing it
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

    // Insert data into the user table
    $db->query('INSERT INTO users (email,password) VALUES (:email,:password)', [
        'email' => $data['email'],
        'password' =>  $data['password']
    ]);
    $_SESSION['user'] = $data['email'];
    header('Location:/');

 
} else {
    // Output validation errors
    views(
        'registration/create.view.php',
        [
            'heading' => 'New User Registration',
            'errors' => $errors
        ]
    );
    return;
    exit();
}
?>
