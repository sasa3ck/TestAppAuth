CREATE DATABASE test_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE test_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_confirmed TINYINT(1) DEFAULT 0,
    confirmation_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
