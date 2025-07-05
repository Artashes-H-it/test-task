<?php

class QueueWorker
{
    private $queue;

    public function __construct(UserFromQueue $queue)
    {
        $this->queue = $queue;
    }

    public function run(): void
    {
        $pendingUsers = $this->queue->getPending();

        if (empty($pendingUsers)) {
            echo "Нет заданий для обработки.";
            return;
        }

        foreach ($pendingUsers as $user) {
            $this->process($user);
        }
    }

    private function process(array $user): void
    {
        echo "Отправка сообщения пользователю:";

        $this->queue->markAsSent((int)$user['id']);
    }
}
