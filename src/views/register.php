<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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

        a {
            text-decoration: none;
            color: inherit;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #ecf0f1;
        }

        .register-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .register-form h2 {
            margin-bottom: 1rem;
        }

        .register-form input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-form button {
            width: 100%;
            padding: 0.75rem;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .register-form button:hover {
            background-color: #18bc9c;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
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
    </style>
</head>

<body>

    <?php require_once __DIR__ . '/components/header.php'; ?>

    <main>
        <form class="register-form" method="POST" action="/register">
            <h2>Регистрация</h2>
            <input type="text" name="first_name" placeholder="Имя" required>
            <input type="text" name="last_name" placeholder="Фамилия" required>
            <input type="email" name="email" placeholder="Электронная почта" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </main>

    <?php require_once __DIR__ . '/components/footer.php'; ?>

</body>

</html>