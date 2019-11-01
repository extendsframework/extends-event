<?php
declare(strict_types=1);

namespace ExtendsFramework\Event\Listener;

use ExtendsFramework\Message\Payload\PayloadInterface;

class ListenerStub extends AbstractEventListener
{
    /**
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * @param PayloadInterface $payload
     */
    public function onPayloadStub(PayloadInterface $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
