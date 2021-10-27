<?php
declare(strict_types=1);
namespace App\Service;

use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\RateLimit\Annotation\RateLimit;
/**
 * 限流适用于所有方法，不仅仅是controller方法，还可以是service方法
 * @RateLimit(limitCallback={RateLimitService::class, "limitCallback"})
 */
class RateLimitService
{
    /**
     * @RateLimit(create=1, capacity=10,consume=10)
     */
    public static function test()
    {
        return ["QPS 1, 峰值3"];
    }

    public static function limitCallback(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        // $seconds 下次生成Token 的间隔, 单位为秒
        // $proceedingJoinPoint 此次请求执行的切入点
        // 可以通过调用 `$proceedingJoinPoint->process()` 继续完成执行，或者自行处理
        return ['limitCallback'];
        //return $proceedingJoinPoint->process();
    }
}