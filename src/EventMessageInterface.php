<?php
declare(strict_types=1);

namespace ExtendsFramework\Event;

use DateTime;
use ExtendsFramework\Message\MessageInterface;

interface EventMessageInterface extends MessageInterface
{
    /**
     * Get date time when event occurred on.
     *
     * @return DateTime
     */
    public function getOccurredOn(): DateTime;
}
