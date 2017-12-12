<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Publisher;

use ExtendsFramework\Event\EventMessageInterface;

interface EventPublisherInterface
{
    /**
     * Publish event message to listeners.
     *
     * Event message will be dispatched to listener when it is registered for payload type name.
     *
     * @param EventMessageInterface $eventMessage
     * @return void
     */
    public function publish(EventMessageInterface $eventMessage): void;
}
