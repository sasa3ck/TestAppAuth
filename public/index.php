<?php

use Dotenv\Dotenv;
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\VerityController;

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
  case '/':
    $controller = new HomeController();
    $controller->showHomePage();
    break;
  case '/home':
    $controller = new HomeController();
    $controller->showHomePage();
    break;
  case '/register':
    $controller = new RegisterController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $controller->handleRegister();
    } else {
      $controller->showRegisterForm();
    }
    break;
  case '/login':
    $controller = new LoginController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $controller->handleLogin();
    } else {
      $controller->showLoginForm();
    }
    break;
  case '/logout':
    $controller = new LogoutController();
    $controller->handleLogout();
    break;
  case '/verify':
    if (isset($_GET['token'])) {
      $controller = new VerityController();
      $controller->handleVerity();
    } else {
      echo "Token is missing.";
    }
    break;
  case '/resend-verification':
    $controller = new LoginController();
    $controller->resendVerification();
    break;
  default:
    echo "Page not found";
    break;
}
