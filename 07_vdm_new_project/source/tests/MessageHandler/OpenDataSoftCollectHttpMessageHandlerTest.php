<?php

namespace App\Tests\MessageHandler;

use App\Message\OpenDataSoftStoreMessage;
use App\MessageHandler\OpenDataSoftCollectHttpMessageHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Vdm\Bundle\LibraryHttpTransportBundle\Message\HttpMessage;

class OpenDataSoftCollectHttpMessageHandlerTest extends TestCase
{
    public function testInvoke()
    {
        $middleware = $this->getMockBuilder(MessageBusInterface::class)->getMock();
        $middleware
            ->expects($this->exactly(1))
            ->method('dispatch')
            ->with(
                $this->callback(function ($message) {
                    $this->assertInstanceOf(OpenDataSoftStoreMessage::class, $message);
                    $this->assertEquals(
                        ['id' => "1", 'lat' => 1.0, 'long' => 2.0, "name" => "Fontainebleau"],
                        $message->getPayload()
                    );
                    return true;
                })
            )
            ->willReturn(new Envelope(new \stdClass()));

        $handler = new OpenDataSoftCollectHttpMessageHandler($middleware);
        $handler(new HttpMessage([
            'fields' => [
                "objectid_1" => "1",
                "geo_point_2d" => [
                    1.0,
                    2.0
                ],
                "nomzonelab" => "Fontainebleau"
            ]
        ]));
    }
}
