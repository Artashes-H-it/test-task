<?php

include 'UsersAddQueue.php';
include __DIR__ . '/../db/Database.php';

$conn = Database::getInstance()->getConnection();
$queue = new UsersAddQueue($conn);

$sql = "SELECT * FROM users WHERE is_send = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        $queue->addUserToQueue($user);
    }
} else {
    echo "Нет пользователей для обработки.";
}
