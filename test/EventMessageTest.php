<?php
declare(strict_types=1);

namespace ExtendsFramework\Event;

use DateTime;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use PHPUnit\Framework\TestCase;

class EventMessageTest extends TestCase
{
    /**
     * Get occurred on.
     *
     * Test that method returns correct value.
     *
     * @covers \ExtendsFramework\Event\EventMessage::__construct()
     * @covers \ExtendsFramework\Event\EventMessage::getOccurredOn()
     */
    public function testGetOccurredOn(): void
    {
        $payload = $this->createMock(PayloadInterface::class);
        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $occurredOn = $this->createMock(DateTime::class);

        /**
         * @var PayloadInterface     $payload
         * @var PayloadTypeInterface $payloadType
         * @var DateTime             $occurredOn
         */
        $message = new EventMessage($payload, $payloadType, $occurredOn, ['foo' => 'bar']);

        $this->assertSame($occurredOn, $message->getOccurredOn());
    }
}
