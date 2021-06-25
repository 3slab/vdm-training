<?php

namespace App\Message;

class AsyncActionMessage
{
    /**
     * @var string $userId
     */
    public $action;

    /**
     * @var int $userId
     */
    public $userId;

    /**
     * @var
     */
    public function __construct(string $action, int $userId)
    {
        $this->action = $action;
        $this->userId = $userId;
    }
}