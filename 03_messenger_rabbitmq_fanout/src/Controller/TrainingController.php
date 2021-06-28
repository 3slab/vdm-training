<?php

namespace App\Controller;

use App\Fanout\Message\FanoutActionMessage;
use App\Async\Message\AsyncActionMessage;
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
     * @param string $appEnv
     * @return Response
     */
    public function sync(MessageBusInterface $bus, string $appEnv)
    {
        echo '<pre>';
        echo "start of the controller action" . PHP_EOL;
        echo "---------------------" . PHP_EOL;

        if ($appEnv === 'fanout' || $appEnv === 'kafka') {
            $message = new FanoutActionMessage('update', 123);
        } elseif ($appEnv === 'async') {
            $message = new AsyncActionMessage('update', 123);
        } else {
            throw new \Exception('wrong environment !!!!');
        }

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
