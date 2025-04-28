<?php

namespace App\Controllers;

class LogoutController
{
    public function handleLogout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /login");
        exit;
    }
}
