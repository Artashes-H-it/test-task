<?php

include __DIR__ . '/../../db/Database.php';


class HomeController extends Controller
{
    private $conn;
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }
    public function index(): void
    {
        $user = new User();
        $data = $user->getName();
        $this->view('home', $data);
    }

    public function upload(): void
    {
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];

                if (($handle = fopen($fileTmpPath, "r")) !== false) {
                    fgetcsv($handle, 1000, ",");

                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        $number = $this->conn->real_escape_string($data[0]);
                        $name = $this->conn->real_escape_string($data[1]);

                        $check = $this->conn->query("SELECT id FROM users WHERE number = '$number'");
                        if ($check->num_rows > 0) {
                            continue;
                        }

                        $sql = "INSERT INTO users (number, name) VALUES ('$number', '$name')";
                        if (!$this->conn->query($sql)) {
                            echo "Error: " . $this->conn->error . "<br>";
                        }
                    }

                    fclose($handle);
                    echo "Данные успешно импортированы.";
                } else {
                    echo "Не удалось открыть файл.";
                }
            } else {
                echo "Ошибка загрузки файла.";
            }
        }
}
