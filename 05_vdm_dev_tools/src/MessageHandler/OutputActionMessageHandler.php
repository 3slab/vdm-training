<?php

namespace App\MessageHandler;

use App\Message\OutputActionMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

/**
 * Class OutputActionMessageHandler
 * @package App\Fanout\MessageHandler
 */
class OutputActionMessageHandler implements MessageSubscriberInterface
{
    /**
     * @param OutputActionMessage $message
     */
    public function __invoke(OutputActionMessage $message)
    {
        dump($message);
    }

    /**
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield OutputActionMessage::class;
    }
}
