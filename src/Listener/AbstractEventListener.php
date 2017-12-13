<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Message\Payload\PayloadMethodTrait;

abstract class AbstractEventListener implements EventListenerInterface
{
    use PayloadMethodTrait;

    /**
     * Prefix for method.
     *
     * @var string
     */
    protected $prefix = 'listen';

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

        $this->getMethod($eventMessage)($eventMessage->getPayload());
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
