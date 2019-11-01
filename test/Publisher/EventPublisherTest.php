<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Publisher;

use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Event\Listener\EventListenerInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class EventPublisherTest extends TestCase
{
    /**
     * Publish.
     *
     * Test that event message will be published to correct listener.
     *
     * @covers \ExtendsFramework\Event\Publisher\EventPublisher::addEventListener()
     * @covers \ExtendsFramework\Event\Publisher\EventPublisher::publish()
     */
    public function testPublish(): void
    {
        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadFoo');

        $message = $this->createMock(EventMessageInterface::class);
        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $listener = $this->createMock(EventListenerInterface::class);
        $listener
            ->expects($this->once())
            ->method('dispatch')
            ->with($message);

        /**
         * @var EventListenerInterface $listener
         * @var EventMessageInterface  $message
         */
        $publisher = new EventPublisher();
        $publisher
            ->addEventListener($listener, 'PayloadBar')
            ->addEventListener($listener, 'PayloadFoo')
            ->publish($message);
    }
}
