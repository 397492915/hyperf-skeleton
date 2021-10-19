<?php


namespace App\JsonRpc;


use Hyperf\RpcClient\AbstractServiceClient;

/**
 * 消费者类
 * Class TestServiceConsumer
 * @package App\JsonRpc
 */
class TestServiceConsumer extends AbstractServiceClient implements TestServiceInterface
{
    /**
     * 定义对应服务提供者的服务名称
     * @var string
     */
    protected $serviceName = 'TestService';

    /**
     * 定义对应服务提供者的服务协议
     * @var string
     */
    protected $protocol = 'jsonrpc-http';

    public function add(int $a, int $b): int
    {
        return $this->__request(__FUNCTION__, compact('a', 'b'));
    }
}