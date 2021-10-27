<?php

namespace App\Controller;

use App\Service\RateLimitService;

/**
 * 微服务-限流
 * Class RateLimitController
 * @package App\Controller
 */
class RateLimitController
{
    public function test()
    {
        return RateLimitService::test();
    }
}