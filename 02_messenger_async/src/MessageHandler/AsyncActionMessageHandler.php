<?php

namespace App\MessageHandler;

use App\Message\AsyncActionMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class AsyncActionMessageHandler
 * @package App\MessageHandler
 */
class AsyncActionMessageHandler implements MessageHandlerInterface
{
    /**
     * @param AsyncActionMessage $message
     */
    public function __invoke(AsyncActionMessage $message)
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

        return $returnMessage;
    }
}
