<?php

class UsersAddQueue
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function addUserToQueue(array $user): void
    {
        $userId = (int)$user['id'];
        $name = (string)$user['name'];;

        $check = $this->conn->query("SELECT id FROM queue WHERE user_id = $userId");
        if ($check->num_rows > 0) {
            echo "Пользователь {$name} уже в очереди.";
            return;
        }

        $sql = "INSERT INTO queue (user_id)VALUES ($userId)";

        if ($this->conn->query($sql)) {

            $stmt = $this->conn->prepare("UPDATE users SET is_send = 1 WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            echo "Пользователь {$name} добавлен в очередь";

        } else {
            echo " Ошибка при добавлении {$name}: " . $this->conn->error . "<br>";
        }
    }
}
