<?php

namespace App\Controllers;

use App\Models\User;

class RegisterController
{
    public function showRegisterForm()
    {
        require_once __DIR__ . '/../views/register.php';
    }

    public function handleRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user = new User();
            $user->register($first_name, $last_name, $email, $password);

            header("Location: /login");
            exit;
        }
    }
}
