<?php

require_once __DIR__ . '/../../db/Database.php';

$conn = Database::getInstance()->getConnection();
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    is_send BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if (mysqli_query($conn, $sql)) {
    echo "Таблица users успешно создана\n";
} else {
    echo "Ошибка при миграции: \n";
}
