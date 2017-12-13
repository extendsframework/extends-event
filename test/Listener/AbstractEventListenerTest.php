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
     * @covers \ExtendsFramework\Event\Listener\AbstractEventListener::getMethod()
     * @covers \ExtendsFramework\Event\Listener\AbstractEventListener::getPrefix()
     * @covers \ExtendsFramework\Event\Listener\AbstractEventListener::getMetaData()
     * @covers \ExtendsFramework\Event\Listener\AbstractEventListener::getOccurredOn()
     */
    public function testDispatch(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadStub');

        $occurredOn = $this->createMock(DateTime::class);

        $eventMessage = $this->createMock(EventMessageInterface::class);
        $eventMessage
            ->method('getPayload')
            ->willReturn($payload);

        $eventMessage
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $eventMessage
            ->method('getMetaData')
            ->willReturn(['foo' => 'bar']);

        $eventMessage
            ->method('getOccurredOn')
            ->willReturn($occurredOn);

        /**
         * @var EventMessageInterface $eventMessage
         */
        $listener = new ListenerStub();
        $listener->dispatch($eventMessage);

        $this->assertSame($payload, $listener->getPayload());
        $this->assertSame($occurredOn, $listener->getOccurredOn());
        $this->assertSame(['foo' => 'bar'], $listener->getMetaData());
    }

    /**
     * Method not found.
     *
     * Test that event listener can not be found and an exception will be thrown.
     *
     * @covers                   \ExtendsFramework\Event\Listener\AbstractEventListener::dispatch()
     * @covers                   \ExtendsFramework\Event\Listener\AbstractEventListener::getMethod()
     * @covers                   \ExtendsFramework\Event\Listener\Exception\MethodNotFound::__construct()
     * @expectedException        \ExtendsFramework\Event\Listener\Exception\MethodNotFound
     * @expectedExceptionMessage No event listener method found for payload name "PayloadFoo".
     */
    public function testMethodNotFound(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadFoo');

        $occurredOn = $this->createMock(DateTime::class);

        $eventMessage = $this->createMock(EventMessageInterface::class);
        $eventMessage
            ->method('getPayload')
            ->willReturn($payload);

        $eventMessage
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $eventMessage
            ->method('getMetaData')
            ->willReturn(['foo' => 'bar']);

        $eventMessage
            ->method('getOccurredOn')
            ->willReturn($occurredOn);

        /**
         * @var EventMessageInterface $eventMessage
         */
        $listener = new ListenerStub();
        $listener->dispatch($eventMessage);
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
     * @return array
     */
    public function getMetaData(): array
    {
        return parent::getMetaData();
    }

    /**
     * @return DateTime
     */
    public function getOccurredOn(): DateTime
    {
        return parent::getOccurredOn();
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
