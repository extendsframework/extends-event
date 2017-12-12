<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use DateTime;
use ExtendsFramework\Event\EventMessageInterface;
use ReflectionMethod;

abstract class AbstractEventListener implements EventListenerInterface
{
    /**
     * Prefix for method.
     *
     * @var string
     */
    protected $prefix = 'listen';

    /**
     * Event message meta data.
     *
     * @var array
     */
    protected $metaData;

    /**
     * Date time event message occurred on.
     *
     * @var DateTime
     */
    protected $occurredOn;

    /**
     * @inheritDoc
     */
    public function dispatch(EventMessageInterface $eventMessage): void
    {
        $this->metaData = $eventMessage->getMetaData();
        $this->occurredOn = $eventMessage->getOccurredOn();

        $method = $this->getMethod($eventMessage);

        $method->invokeArgs($this, [$eventMessage->getPayload()]);
    }

    /**
     * Get reflection method for event message payload.
     *
     * Method name is based on the method prefix combined with the payload type name.
     *
     * @param EventMessageInterface $eventMessage
     * @return ReflectionMethod
     */
    protected function getMethod(EventMessageInterface $eventMessage): ReflectionMethod
    {
        $name = $this->prefix . $eventMessage
                ->getPayloadType()
                ->getName();

        return new ReflectionMethod($this, $name);
    }
}
