<?php


namespace App\JsonRpc;


use App\Utils\Log;
use Hyperf\RpcServer\Annotation\RpcService;
use Hyperf\Utils\Coroutine;

/**
 * 注意，如希望通过服务中心来管理服务，需在注解内增加 publishTo 属性
 * @RpcService(name="TestService", protocol="jsonrpc-http", server="toc-rpc" ,publishTo="consul")
 */
class TestService implements TestServiceInterface
{
    // 实现一个加法方法，这里简单的认为参数都是 int 类型
    public function add(int $a, int $b): int
    {
        Log::get()->info(Coroutine::id());
        // 这里是服务方法的具体实现
        return $a * $b;
    }
}