<?php

declare(strict_types=1);

namespace App\Amqp\Producer;

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerMessage;
use Hyperf\Amqp\Message\Type;

/**
 * @Producer()
 */
class DemoProducer extends ProducerMessage
{
    protected $exchange = 'amq.direct';

    protected $type = Type::DIRECT;

    protected $routingKey = 'test';
    public function __construct($data)
    {
        $this->payload = $data;
    }
}
