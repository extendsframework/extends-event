<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Framework\ServiceLocator\Factory;

use ExtendsFramework\Event\Listener\EventListenerInterface;
use ExtendsFramework\Event\Publisher\EventPublisher;
use ExtendsFramework\Event\Publisher\EventPublisherInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorException;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;

class EventPublisherFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     * @throws ServiceLocatorException
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $config = $serviceLocator->getConfig();
        $config = $config[EventPublisherInterface::class] ?? [];

        $publisher = new EventPublisher();
        foreach ($config as $listener => $payloadNames) {
            $listener = $this->getEventListener($serviceLocator, $listener);

            foreach ((array)$payloadNames as $payloadName) {
                $publisher->addEventListener($listener, $payloadName);
            }
        }

        return $publisher;
    }

    /**
     * Get event listener.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param string                  $key
     * @return EventListenerInterface
     * @throws ServiceLocatorException
     */
    private function getEventListener(ServiceLocatorInterface $serviceLocator, string $key): object
    {
        return $serviceLocator->getService($key);
    }
}
