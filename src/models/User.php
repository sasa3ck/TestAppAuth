<?php

namespace App\Models;

use Config\Database;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function register($first_name, $last_name, $email, $password)
    {
        $confirmation_token = bin2hex(random_bytes(16));

        $stmt = $this->pdo->prepare('INSERT INTO users (first_name, last_name, email, password, confirmation_token) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$first_name, $last_name, $email, $password, $confirmation_token]);

        $this->sendConfirmationEmail($email, $confirmation_token);
        header("Location: /login");
    }

    public function sendVerificationEmail($email)
    {
        $confirmation_token = bin2hex(random_bytes(16));

        $stmt = $this->pdo->prepare('UPDATE users SET confirmation_token = ? WHERE email = ?');
        $stmt->execute([$confirmation_token, $email]);

        $this->sendConfirmationEmail($email, $confirmation_token);
    }

    function sendConfirmationEmail($email, $token)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = $_ENV['MAIL_SMTPAUTH'];
            $mail->Username = $_ENV['MAIL_USERNAME'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
            $mail->Port = $_ENV['MAIL_PORT'];

            $mail->setFrom('076798252@mail.ru', 'Your App Name');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Confirm your registration';
            $mail->Body    = "To verify your account, please add a link here: <br><br><a href='http://localhost/verify?token=$token'>Verify account</a>";

            $mail->send();
        } catch (Exception $e) {
            echo "Ошибка отправки сообщения. Почта не была отправлена. Ошибка: {$mail->ErrorInfo}";
        }
    }

    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            return false;
        }

        try {
            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_start();

                unset($user['password']);

                $_SESSION['user'] = $user;
                $_SESSION['loggedin'] = true;

                session_regenerate_id(true);

                return true;
            }
        } catch (PDOException $e) {
            error_log('Login error: ' . $e->getMessage());
        }

        return false;
    }
}
