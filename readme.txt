1. Homepage  "http://test-tasck/public/".
2. Отправка CSV-файла по адресу "http://test-tasck/public/api/upload". Key = "file", Value = filename.csv

3. Команда для отправки в очередь "php queue/SendUsersQueue.php"
4. Команда для отправки из очередей "php queue/Worker.php"
5. Команда для миграции "php migrations/migrate.php
"
