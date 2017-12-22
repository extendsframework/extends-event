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
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): EventPublisherInterface
    {
        $config = $serviceLocator->getConfig();
        $config = $config[EventPublisherInterface::class] ?? [];

        $publisher = new EventPublisher();
        foreach ($config as $key => $payloadNames) {
            $listener = $this->getEventListener($serviceLocator, $key);

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
    protected function getEventListener(ServiceLocatorInterface $serviceLocator, string $key): EventListenerInterface
    {
        return $serviceLocator->getService($key);
    }
}
