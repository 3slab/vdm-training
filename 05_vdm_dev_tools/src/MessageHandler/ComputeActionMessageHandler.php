<?php

namespace App\MessageHandler;

use App\Message\ComputeActionMessage;
use App\Message\OutputActionMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class ComputeActionMessageHandler
 * @package App\MessageHandler
 */
class ComputeActionMessageHandler implements MessageSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    protected $bus;

    /**
     * OutputActionMessageHandler constructor.
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param ComputeActionMessage $message
     */
    public function __invoke(ComputeActionMessage $message)
    {
        echo "start of the message handler action" . PHP_EOL . PHP_EOL;

        $payload = $message->getPayload();

        $payload['email'] = 'myemail@gmail.com';

        $outputMessage = OutputActionMessage::createFrom($message, $payload);
        $this->bus->dispatch($outputMessage);

        echo "end of the message handler action" . PHP_EOL . PHP_EOL;
    }

    /**
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield ComputeActionMessage::class;
    }
}
