<?php

namespace Core;

use core\App;
use PDO;
use core\Database;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
                'email' => $email
            ])->find(PDO::FETCH_ASSOC);
        if ($user) {

            if (password_verify($password, $user['password'])) {
                $this->login($user['email']);
                return true;
            }
        }
        return false;
    }
    public function login($user)
    {
        $_SESSION['user'] = $user;
        session_regenerate_id(true);
    }
    public function logout()
    {
        Session::destroy();
    }
    function old($key, $default = '')
    {
        return Session::get('old')[$key] ?? $default;
    }
}
