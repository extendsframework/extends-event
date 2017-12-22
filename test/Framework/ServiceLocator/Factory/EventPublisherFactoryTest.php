<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Framework\ServiceLocator\Factory;

use ExtendsFramework\Event\Listener\EventListenerInterface;
use ExtendsFramework\Event\Publisher\EventPublisherInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class EventPublisherFactoryTest extends TestCase
{
    /**
     * Create service.
     *
     * Test that command dispatcher will be created from config.
     *
     * @covers \ExtendsFramework\Event\Framework\ServiceLocator\Factory\EventPublisherFactory::createService()
     * @covers \ExtendsFramework\Event\Framework\ServiceLocator\Factory\EventPublisherFactory::getEventListener()
     */
    public function testCreateService(): void
    {
        $handler = $this->createMock(EventListenerInterface::class);

        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->method('getConfig')
            ->willReturn([
                EventPublisherInterface::class => [
                    'FooListener' => [
                        'FooEvent',
                        'QuxEvent',
                    ],
                    'BarListener' => 'BarEvent',
                ],
            ]);

        $serviceLocator
            ->method('getService')
            ->withConsecutive(
                ['FooListener'],
                ['BarListener']
            )
            ->willReturn($handler);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $factory = new EventPublisherFactory();
        $dispatcher = $factory->createService(EventPublisherInterface::class, $serviceLocator);

        $this->assertInstanceOf(EventPublisherInterface::class, $dispatcher);
    }
}
