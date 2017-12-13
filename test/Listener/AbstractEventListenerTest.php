<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use DateTime;
use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class AbstractEventListenerTest extends TestCase
{
    /**
     * Dispatch.
     *
     * Test that event message will be dispatched to correct method.
     *
     * @covers \ExtendsFramework\Event\Listener\AbstractEventListener::dispatch()
     * @covers \ExtendsFramework\Event\Listener\AbstractEventListener::getEventMessage()
     */
    public function testDispatch(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadStub');

        $message = $this->createMock(EventMessageInterface::class);
        $message
            ->method('getPayload')
            ->willReturn($payload);

        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        /**
         * @var EventMessageInterface $message
         */
        $listener = new ListenerStub();
        $listener->dispatch($message);

        $this->assertSame($payload, $listener->getPayload());
        $this->assertSame($message, $listener->getEventMessage());
    }
}

class ListenerStub extends AbstractEventListener
{
    /**
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * @param PayloadInterface $payload
     */
    public function listenPayloadStub(PayloadInterface $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return EventMessageInterface
     */
    public function getEventMessage(): EventMessageInterface
    {
        return parent::getEventMessage();
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
