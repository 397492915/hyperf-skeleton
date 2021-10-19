<?php


namespace App\JsonRpc;


use App\Utils\Log;
use Hyperf\RpcServer\Annotation\RpcService;
use Hyperf\Utils\Coroutine;

/**
 * 服务提供者
 * @RpcService(name="CalculatorService", protocol="jsonrpc-http", server="toc-rpc" ,publishTo="consul")
 */
class CalculatorService implements CalculatorServiceInterface
{
    // 实现一个加法方法，这里简单的认为参数都是 int 类型
    public function add(int $a, int $b): int
    {
        Log::get()->info(Coroutine::id());
        // 这里是服务方法的具体实现
        return $a + $b;
    }
}