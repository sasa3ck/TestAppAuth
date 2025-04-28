<?php

namespace App\Controllers;

use App\Models\User;
use Config\Database;

class VerityController
{
    public function handleVerity()
    {
        if (!isset($_GET['token'])) {
            die('Неверный запрос.');
        }

        $token = $_GET['token'];
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('SELECT id FROM users WHERE confirmation_token = ?');
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if ($user) {
            $stmt = $pdo->prepare('UPDATE users SET is_confirmed = 1, confirmation_token = NULL WHERE id = ?');
            $stmt->execute([$user['id']]);
            echo 'Ваш аккаунт подтвержден! Теперь вы можете войти.';
        } else {
            echo 'Неверный токен подтверждения.';
        }
    }
}
