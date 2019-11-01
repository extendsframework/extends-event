<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Framework\ServiceLocator\Factory;

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
            $listener = $serviceLocator->getService($listener);

            foreach ((array)$payloadNames as $payloadName) {
                /** @noinspection PhpParamsInspection */
                $publisher->addEventListener($listener, $payloadName);
            }
        }

        return $publisher;
    }
}
