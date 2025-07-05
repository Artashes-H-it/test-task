<?php

require_once __DIR__ . '/../db/Database.php';
require_once __DIR__ . '/UserFromQueue.php';
require_once __DIR__ . '/QueueWorker.php';

$conn = Database::getInstance()->getConnection();
$queue = new UserFromQueue($conn);
$worker = new QueueWorker($queue);

$worker->run();
