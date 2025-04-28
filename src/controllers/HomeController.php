<?php

namespace App\Controllers;

class HomeController
{
  public function showHomePage()
  {
    session_start();
    $pdo = \Config\Database::getConnection();
    $stmt = $pdo->prepare('SELECT is_confirmed FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user']['id']]);
    $result = $stmt->fetch();

    $isConfirmed = $result['is_confirmed'] ?? null;

    require_once __DIR__ . '/../views/index.php';
  }
}
