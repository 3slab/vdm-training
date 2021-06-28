<?php

namespace App\Fanout\MessageHandler;

use App\Fanout\Message\FanoutActionMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

/**
 * Class Fanout2ActionMessageHandler
 * @package App\Fanout\MessageHandler
 */
class Fanout2ActionMessageHandler implements MessageSubscriberInterface
{
    /**
     * @param FanoutActionMessage $message
     * @return FanoutActionMessage
     */
    public function __invoke(FanoutActionMessage $message)
    {
        echo "start of the message handler action for fanout2" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        dump($message);

        echo "---------------------" . PHP_EOL;
        echo "handling message ...." . PHP_EOL;

        $message->userId = 999;

        echo "---------------------" . PHP_EOL;
        echo "end of the message handler action for fanout2" . PHP_EOL;
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
        yield FanoutActionMessage::class => [
            'from_transport' => 'fanout2'
        ];
    }
}
