<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use ExtendsFramework\Event\EventMessageInterface;

interface EventListenerInterface
{
    /**
     * Dispatch event message to listener.
     *
     * @param EventMessageInterface $eventMessage
     * @return void
     */
    public function dispatch(EventMessageInterface $eventMessage): void;
}
