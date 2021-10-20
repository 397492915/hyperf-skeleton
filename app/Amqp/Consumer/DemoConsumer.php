<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Utils\Log;
use Hyperf\Amqp\Message\Type;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * @Consumer(nums=1)
 */
class DemoConsumer extends ConsumerMessage
{
    protected $exchange = 'amq.direct';

    protected $queue = 'test';

    protected $type = Type::DIRECT;

    protected $routingKey = 'test';

    //设置为false时，不会自动启动消费者进程进行消费
    protected $enable = true;

    public function consumeMessage($data, AMQPMessage $message): string
    {
        //$data即为生产者投递的原始数据，没有做封装
        //{"0":1,"1":2,"2":3,"a":"b"}
        Log::get()->info(json_encode($data));

        //$message，AMQPMessage包含amqp的元数据
        //{"body":"{\"0\":1,\"1\":2,\"2\":3,\"a\":\"b\"}","body_size":27,"is_truncated":false,"content_encoding":null,"delivery_info":{"channel":{"callbacks":{"amq.ctag-vL4uxGl3W3Zvt8Xta2flPA":{}}},"delivery_tag":2,"redelivered":false,"exchange":"amq.direct","routing_key":"test","consumer_tag":"amq.ctag-vL4uxGl3W3Zvt8Xta2flPA"}}
        Log::get()->info(json_encode($message));
        return Result::ACK;
    }
}
