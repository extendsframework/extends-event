<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Publisher;

use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Event\Listener\EventListenerInterface;

class EventPublisher implements EventPublisherInterface
{
    /**
     * Event listeners grouped by payload name.
     *
     * @var EventListenerInterface[][]
     */
    protected $eventListeners = [];

    /**
     * @inheritDoc
     */
    public function publish(EventMessageInterface $eventMessage): void
    {
        $eventListeners = $this->getEventListeners($eventMessage);
        foreach ($eventListeners as $eventListener) {
            $eventListener->dispatch($eventMessage);
        }
    }

    /**
     * Add event listener.
     *
     * @param EventListenerInterface $eventListener
     * @param string                 $payloadName
     * @return EventPublisher
     */
    public function addListener(EventListenerInterface $eventListener, string $payloadName): EventPublisher
    {
        $this->eventListeners[$payloadName][] = $eventListener;

        return $this;
    }

    /**
     * Get event listeners.
     *
     * @param EventMessageInterface $eventMessage
     * @return EventListenerInterface[]
     */
    protected function getEventListeners(EventMessageInterface $eventMessage): array
    {
        return $this->eventListeners[$eventMessage->getPayloadType()->getName()] ?? [];
    }
}