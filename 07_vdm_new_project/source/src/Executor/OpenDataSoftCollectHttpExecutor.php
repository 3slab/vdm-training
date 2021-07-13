<?php

namespace App\Executor;

use Symfony\Component\Messenger\Envelope;
use Vdm\Bundle\LibraryBundle\Stamp\StopAfterHandleStamp;
use Vdm\Bundle\LibraryHttpTransportBundle\Executor\DefaultHttpExecutor;
use Vdm\Bundle\LibraryHttpTransportBundle\Message\HttpMessage;

class OpenDataSoftCollectHttpExecutor extends DefaultHttpExecutor
{
    /**
     * {@inheritDoc}
     * Add decode response content to default execution
     */
    public function execute(string $dsn, string $method, array $options): iterable
    {
        // In HttpClient, request just build the request but does not execute it
        $response = $this->httpClient->request($method, $dsn, $options);

        $this->logger->debug(sprintf('%s - Requesting %s %s', static::class, $method, $dsn));

        $data = json_decode($response->getContent(), true);

        foreach ($data["records"] as $key => $record) {
            $message = new HttpMessage($record);
            $stamps = ($key === (count($data["records"]) - 1)) ? [new StopAfterHandleStamp()] : [];
            yield new Envelope($message, $stamps);
        }
    }
}
