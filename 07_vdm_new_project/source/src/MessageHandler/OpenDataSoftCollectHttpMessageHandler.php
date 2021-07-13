<?php

namespace App\MessageHandler;

use App\Message\OpenDataSoftStoreMessage;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Vdm\Bundle\LibraryHttpTransportBundle\Message\HttpMessage;

/**
 * Class OpenDataSoftCollectHttpMessageHandler
 * @package App\MessageHandler
 */
class OpenDataSoftCollectHttpMessageHandler implements MessageSubscriberInterface
{
    /**
     * @var MessageBusInterface
     */
    protected $bus;

    /**
     * OpenDataSoftCollectHttpMessageHandler constructor.
     * @param MessageBusInterface $bus
     */
    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param HttpMessage $message
     */
    public function __invoke(HttpMessage $message)
    {
        $data = $message->getPayload();

        $culturalSite = [
            "id" => $data["fields"]["objectid_1"],
            "lat" => $data["fields"]["geo_point_2d"][0],
            "long" => $data["fields"]["geo_point_2d"][1],
            "name" => $data["fields"]["nomzonelab"],
        ];

        $toStoreMessage = OpenDataSoftStoreMessage::createFrom($message, $culturalSite);
        $this->bus->dispatch($toStoreMessage);
    }

    /**
     * @return iterable
     */
    public static function getHandledMessages(): iterable
    {
        yield HttpMessage::class => [
            'from_transport' => 'opendatasoft-collect'
        ];
    }
}
