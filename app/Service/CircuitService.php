<?php
declare(strict_types=1);
namespace App\Service;

use App\Utils\Log;
use Hyperf\CircuitBreaker\Annotation\CircuitBreaker;
/**
 * 熔断降级适用于所有方法，不仅仅是controller方法，还可以是service方法
 */
class CircuitService
{
    /**
     * @CircuitBreaker(timeout=1, failCounter=1, successCounter=1, fallback="App\Service\CircuitService::searchFallback")
     * @throws \Exception
     */
    public static function test()
    {
        Log::get()->info('CircuitService::test');
        sleep(2);
        return ['circuit'];
    }

    public static function searchFallback()
    {
        return ['searchFallback'];
    }
}