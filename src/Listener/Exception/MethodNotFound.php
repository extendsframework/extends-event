<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener\Exception;

use ExtendsFramework\Event\Listener\EventListenerException;
use InvalidArgumentException;

class MethodNotFound extends InvalidArgumentException implements EventListenerException
{
    /**
     * MethodNotFound constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct(sprintf(
            'No event listener method found for payload name "%s".',
            $name
        ));
    }
}
