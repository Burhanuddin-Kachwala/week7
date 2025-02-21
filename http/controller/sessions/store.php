<?php

use core\App;
use core\Database;
use core\Authenticator;
use Core\Session;

use http\Forms\LoginForm;

$db = App::resolve(Database::class);

$data = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

$form = new LoginForm();

if ($form->validate($data['email'], $data['password'])) {

    if ((new Authenticator())->attempt($data['email'], $data['password'])) {
        redirect('/');
     }

    $form->error('password', 'No Matching Account Found');
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $_POST['email']
]);
return redirect('/login');
