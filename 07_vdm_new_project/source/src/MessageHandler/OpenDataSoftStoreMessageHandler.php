<?php

namespace App\MessageHandler;

use App\Message\OpenDataSoftPersistMessage;
use App\Message\OpenDataSoftStoreMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class OpenDataSoftStoreMessageHandler
 * @package App\MessageHandler
 */
class OpenDataSoftStoreMessageHandler implements MessageSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    protected $bus;

    /**
     * OpenDataSoftStoreMessageHandler constructor.
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param OpenDataSoftStoreMessage $message
     */
    public function __invoke(OpenDataSoftStoreMessage $message)
    {
        $outputMessage = OpenDataSoftPersistMessage::createFrom($message);
        $this->bus->dispatch($outputMessage);
    }

    /**
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield OpenDataSoftStoreMessage::class => [
            'from_transport' => 'opendatasoft-store'
        ];
    }
}
