<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Framework\ServiceLocator\Loader;

use ExtendsFramework\Event\Framework\ServiceLocator\Factory\EventPublisherFactory;
use ExtendsFramework\Event\Publisher\EventPublisherInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class EventConfigLoaderTest extends TestCase
{
    /**
     * Load.
     *
     * Test that correct config will be loaded.
     *
     * @covers \ExtendsFramework\Event\Framework\ServiceLocator\Loader\EventConfigLoader::load()
     */
    public function testLoad(): void
    {
        $loader = new EventConfigLoader();

        $this->assertSame([
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    EventPublisherInterface::class => EventPublisherFactory::class,
                ],
            ],
            EventPublisherInterface::class => [],
        ], $loader->load());
    }
}
