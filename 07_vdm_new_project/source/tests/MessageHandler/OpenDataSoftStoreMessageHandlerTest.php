<?php

namespace App\Tests\MessageHandler;

use App\Message\OpenDataSoftPersistMessage;
use App\Message\OpenDataSoftStoreMessage;
use App\MessageHandler\OpenDataSoftStoreMessageHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class OpenDataSoftStoreMessageHandlerTest extends TestCase
{
    public function testInvoke()
    {
        $middleware = $this->getMockBuilder(MessageBusInterface::class)->getMock();
        $middleware
            ->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->callback(function ($message) {
                    $this->assertInstanceOf(OpenDataSoftPersistMessage::class, $message);
                    $this->assertEquals('1', $message->getPayload()['id']);
                    $this->assertEquals(1.0, $message->getPayload()['lat']);
                    $this->assertEquals(2.0, $message->getPayload()['long']);
                    $this->assertEquals('Fontainebleau', $message->getPayload()['name']);
                    return true;
                })
            )
            ->willReturn(new Envelope(new \stdClass()));

        $handler = new OpenDataSoftStoreMessageHandler($middleware);
        $handler(new OpenDataSoftStoreMessage([
            'id' => "1",
            'lat' => 1.0,
            'long' => 2.0,
            'name' => "Fontainebleau"
        ]));
    }
}
