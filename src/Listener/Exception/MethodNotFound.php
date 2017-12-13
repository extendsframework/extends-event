<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener\Exception;

use ExtendsFramework\Event\EventMessageInterface;
use ExtendsFramework\Event\Listener\EventListenerException;
use InvalidArgumentException;

class MethodNotFound extends InvalidArgumentException implements EventListenerException
{
    /**
     * MethodNotFound constructor.
     *
     * @param EventMessageInterface $eventMessage
     */
    public function __construct(EventMessageInterface $eventMessage)
    {
        parent::__construct(sprintf(
            'No event listener method found for payload name "%s".',
            $eventMessage
                ->getPayloadType()
                ->getName()
        ));
    }
}
