<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use DateTime;
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

        $this->getMethod($eventMessage)($eventMessage->getPayload());
    }

    /**
     * Get meta data.
     *
     * @return array
     */
    protected function getMetaData(): array
    {
        return $this->metaData;
    }

    /**
     * Get occurred on.
     *
     * @return DateTime
     */
    protected function getOccurredOn(): DateTime
    {
        return $this->occurredOn;
    }
}
