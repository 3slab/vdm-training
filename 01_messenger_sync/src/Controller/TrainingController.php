<?php

namespace App\Controller;

use App\Message\SyncActionMessage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class TrainingController
 * @package App\Controller
 */
class TrainingController
{
    /**
     * @param MessageBusInterface $bus
     */
    public function sync(MessageBusInterface $bus)
    {
        echo '<pre>';
        echo "start of the controller action" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        $message = new SyncActionMessage('update', 123);

        dump($message);

        echo "dispatching message to the bus from the controller" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        $handledMessage = $bus->dispatch($message);

        dump($handledMessage);
        dump($handledMessage->getMessage());

        echo "end of the controller action" . PHP_EOL;
        echo "---------------------" . PHP_EOL;
        echo '</pre>';

        return new Response('');
    }
}
