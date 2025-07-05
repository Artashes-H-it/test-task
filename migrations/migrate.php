<?php

require_once __DIR__ . '/../db/Database.php';

$conn = Database::getInstance()->getConnection();

$files = glob(__DIR__ . '/migration-tables/*.php');
sort($files);

foreach ($files as $file) {
    echo "Выполняется: " . basename($file) . "\n";
    $flag = include $file;
    var_dump($flag);
    if($flag) {
       continue;
    }
}
