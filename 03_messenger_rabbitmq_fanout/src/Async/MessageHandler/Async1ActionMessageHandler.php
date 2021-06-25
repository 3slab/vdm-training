<?php

namespace App\Async\MessageHandler;

use App\Async\Message\AsyncActionMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

/**
 * Class Async1ActionMessageHandler
 * @package App\MessageHandler
 */
class Async1ActionMessageHandler implements MessageSubscriberInterface
{
    /**
     * @param AsyncActionMessage $message
     * @return AsyncActionMessage
     */
    public function __invoke(AsyncActionMessage $message)
    {
        echo "start of the message handler action for async1" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        dump($message);

        echo "---------------------" . PHP_EOL;
        echo "handling message ...." . PHP_EOL;

        $message->userId = 999;

        echo "---------------------" . PHP_EOL;
        echo "end of the message handler action for async1" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        $returnMessage = clone $message;
        $returnMessage->userId = 777;

        return $returnMessage;
    }

    /**
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield AsyncActionMessage::class => [
            'from_transport' => 'async1'
        ];
    }
}
