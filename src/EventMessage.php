<?php
declare(strict_types=1);

namespace ExtendsFramework\Event;

use DateTime;
use ExtendsFramework\Message\Message;
use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;

class EventMessage extends Message implements EventMessageInterface
{
    /**
     * Date time.
     *
     * @var DateTime
     */
    protected $occurredOn;

    /**
     * EventMessage constructor.
     *
     * @param PayloadInterface     $payload
     * @param PayloadTypeInterface $payloadType
     * @param DateTime             $occurredOn
     * @param array                $metaData
     */
    public function __construct(PayloadInterface $payload, PayloadTypeInterface $payloadType, DateTime $occurredOn, array $metaData)
    {
        parent::__construct($payload, $payloadType, $metaData);

        $this->occurredOn = $occurredOn;
    }

    /**
     * @inheritDoc
     */
    public function getOccurredOn(): DateTime
    {
        return $this->occurredOn;
    }
}
