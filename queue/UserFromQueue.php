<?php
class UserFromQueue
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function getPending(): array
    {
        $result = $this->conn->query("SELECT * FROM queue WHERE status = 'pending'");
        $users = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    public function markAsSent(int $id): void
    {
        $stmt = $this->conn->prepare("UPDATE queue SET status = 'sent' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();


    }
}
