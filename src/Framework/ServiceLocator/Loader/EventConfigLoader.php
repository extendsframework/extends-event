<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Framework\ServiceLocator\Loader;

use ExtendsFramework\Event\Framework\ServiceLocator\Factory\EventPublisherFactory;
use ExtendsFramework\Event\Publisher\EventPublisherInterface;
use ExtendsFramework\ServiceLocator\Config\Loader\LoaderInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;

class EventConfigLoader implements LoaderInterface
{
    /**
     * @inheritDoc
     */
    public function load(): array
    {
        return [
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    EventPublisherInterface::class => EventPublisherFactory::class,
                ],
            ],
            EventPublisherInterface::class => [],
        ];
    }
}
