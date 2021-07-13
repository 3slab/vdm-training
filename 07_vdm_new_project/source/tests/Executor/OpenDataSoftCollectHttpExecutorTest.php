<?php

namespace App\Tests\Executor;

use App\Executor\OpenDataSoftCollectHttpExecutor;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\Messenger\Envelope;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Vdm\Bundle\LibraryBundle\Stamp\StopAfterHandleStamp;
use Vdm\Bundle\LibraryHttpTransportBundle\Message\HttpMessage;

class OpenDataSoftCollectHttpExecutorTest extends TestCase
{
    public function testExecute()
    {
        /** @var HttpClientInterface $httpClient */
        $httpClient = $this->getMockBuilder(HttpClientInterface::class)->getMock();
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'http://myurl', ['key' => 'value'])
            ->willReturn(
                MockResponse::fromRequest(
                    "GET",
                    "http://myurl",
                    ['key' => 'value'],
                    new MockResponse('{"records":[{"value": "1"},{"value": "2"}]}')
                )
            );

        $executor = new OpenDataSoftCollectHttpExecutor($httpClient, new NullLogger());
        $envelopes = iterator_to_array($executor->execute('http://myurl', 'GET', ['key' => 'value']));

        $this->assertCount(2, $envelopes);
        $this->assertInstanceOf(Envelope::class, $envelopes[0]);
        $this->assertArrayNotHasKey(StopAfterHandleStamp::class, $envelopes[0]->all());

        $this->assertInstanceOf(Envelope::class, $envelopes[1]);
        $this->assertArrayHasKey(StopAfterHandleStamp::class, $envelopes[1]->all());

        $message1 = $envelopes[0]->getMessage();
        $this->assertInstanceOf(HttpMessage::class, $message1);
        $this->assertEquals(['value' => '1'], $message1->getPayload());

        $message2 = $envelopes[1]->getMessage();
        $this->assertInstanceOf(HttpMessage::class, $message2);
        $this->assertEquals(['value' => '2'], $message2->getPayload());
    }
}
