<?php

namespace App\MessageHandler;

use App\Message\SyncActionMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class SyncActionMessageHandler
 * @package App\MessageHandler
 */
class SyncActionMessageHandler implements MessageHandlerInterface
{
    /**
     * @param SyncActionMessage $message
     */
    public function __invoke(SyncActionMessage $message)
    {
        echo "start of the message handler action" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        dump($message);

        echo "---------------------" . PHP_EOL;
        echo "handling message ...." . PHP_EOL;

        $message->userId = 999;

        echo "---------------------" . PHP_EOL;
        echo "end of the message handler action" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        $returnMessage = clone $message;
        $returnMessage->userId = 777;

        return $returnMessage; // <--- return message not available !!!!
    }
}
