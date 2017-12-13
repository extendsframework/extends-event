<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use DateTime;
use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Event\Listener\Exception\MethodNotFound;
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
     * Method name is based on the method prefix combined with payload name.
     *
     * @param EventMessageInterface $eventMessage
     * @return ReflectionMethod
     * @throws EventListenerException
     */
    protected function getMethod(EventMessageInterface $eventMessage): ReflectionMethod
    {
        $name = $eventMessage
            ->getPayloadType()
            ->getName();
        $method = $this->prefix . $name;

        if (method_exists($this, $method) === false) {
            throw new MethodNotFound($eventMessage);
        }

        return new ReflectionMethod($this, $method);
    }
}
