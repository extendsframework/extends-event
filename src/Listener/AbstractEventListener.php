<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractEventListener implements EventListenerInterface
{
    use PayloadMethodTrait;

    /**
     * Event message.
     *
     * @var EventMessageInterface
     */
    protected $eventMessage;

    /**
     * @inheritDoc
     */
    public function dispatch(EventMessageInterface $eventMessage): void
    {
        $this->eventMessage = $eventMessage;

        $this->getMethod($eventMessage, 'on')($eventMessage->getPayload());
    }

    /**
     * Get event message.
     *
     * @return EventMessageInterface
     */
    public function getEventMessage(): EventMessageInterface
    {
        return $this->eventMessage;
    }
}
