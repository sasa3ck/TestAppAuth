<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
{
    public function showLoginForm()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $user = new User();
            if ($user->login($email, $password)) {
                header("Location: /");
                exit;
            } else {
                echo "<div style='text-align: center; margin: 50px; font-size: 50px;'>Неверный данные.<br>Вы будете перенаправлены через 4 секунд...</div>";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '/login';
                    }, 4000);
                </script>";
            }
        }
    }

    public function resendVerification()
    {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            echo 'Вы не авторизованы.';
            exit;
        }

        $userModel = new User();
        $email = $_SESSION['user']['email'];
        $userModel->sendConfirmationEmail($email, $this->generateNewToken($email));

        echo "<div style='text-align: center; margin: 50px; font-size: 50px;'>Письмо с подтверждением было отправлено снова!<br>Вы будете перенаправлены через 4 секунд...</div>";
        echo "<script>
            setTimeout(function() {
                window.location.href = '/';
            }, 4000);
        </script>";
    }

    private function generateNewToken($email)
    {
        $pdo = \Config\Database::getConnection();
        $newToken = bin2hex(random_bytes(16));
        $stmt = $pdo->prepare('UPDATE users SET confirmation_token = ? WHERE email = ?');
        $stmt->execute([$newToken, $email]);
        return $newToken;
    }
}
