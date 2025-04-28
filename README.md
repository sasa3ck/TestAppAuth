## 📋 Функции:
Простое веб-приложение на PHP, реализующее:

- Регистрацию пользователей
- Подтверждение e-mail через письмо
- Авторизацию с проверкой подтверждения
- Выход из аккаунта

Технологии:
- PHP 8+
- MySQL
- PHPMailer для отправки писем
- Чистый MVC-подход (Controllers / Models / Config)

---

## 🛠️ Установка

1. **Клонировать проект:**
- git clone https://github.com/your-username/your-project.git
- cd .\TestAppAuth\
- composer install
- docker-compose up -d --build

2. Настройте базу данных:
- Выполните то что находится в папке "sql->create_users_table.sql"

3. Настройте SMTP отправку писем:

В .env укажите правильные SMTP-параметры:
- $mail->Host = 'smtp.mail.ru';
- $mail->Username = 'your-email@mail.ru';
- $mail->Password = 'your-password';

## ⚙️ Основные роуты
Роут	                  Описание
/ or /home	            Домашняя страница
/register	            Форма регистрации
/login	               Форма входа
/logout	               Выход из аккаунта
/verify?token=TOKEN	   Подтверждение почты
/resend-verification	   Повторная отправка письма