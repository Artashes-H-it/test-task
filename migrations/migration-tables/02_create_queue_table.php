<?php

require_once __DIR__ . '/../../db/Database.php';

$conn = Database::getInstance()->getConnection();
$flag = null;
$sql = "CREATE TABLE IF NOT EXISTS queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    status ENUM('pending', 'sent') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if (mysqli_query($conn, $sql)) {
    echo "Таблица queue успешно создана\n";
} else {
    echo "Ошибка при миграции: \n";
}
return $flag = true;
