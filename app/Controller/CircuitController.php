<?php

namespace App\Controller;

use App\Service\CircuitService;

/**
 * 微服务-熔断-降级
 * Class CircuitController
 * @package App\Controller
 */
class CircuitController
{
    public function test()
    {
        return CircuitService::test();
    }
}