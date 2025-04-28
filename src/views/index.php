<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 1rem;
            font-size: 1rem;
            transition: color 0.3s;
        }

        header nav a:hover {
            color: #18bc9c;
        }

        @media (max-width: 600px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            header nav {
                margin-top: 0.5rem;
            }
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            text-align: center;
            background-color: #ecf0f1;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <?php require_once __DIR__ . '/components/header.php'; ?>

    <main>
        <h1>Добро пожаловать на наш сайт!</h1>
        <?php if (isset($isConfirmed) && $isConfirmed == 0): ?>
            <div style="background-color: #ffcccc; padding: 10px; margin-bottom: 10px; border: 1px solid red;">
                Пожалуйста, подтвердите ваш e-mail для полного доступа к сайту.
                <a href="/resend-verification">Отправить письмо снова</a>
            </div>
        <?php endif; ?>
    </main>

    <?php require_once __DIR__ . '/components/footer.php'; ?>

</body>

</html>