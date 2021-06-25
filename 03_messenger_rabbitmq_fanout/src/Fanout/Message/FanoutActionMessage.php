<?php

namespace App\Fanout\Message;

class FanoutActionMessage
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