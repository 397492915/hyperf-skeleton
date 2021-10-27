<?php

namespace App\Controller;

use App\Service\RetryService;

/**
 * 微服务-重试
 * Class RetryController
 * @package App\Controller
 */
class RetryController
{
    /**
     * @return string[]
     */
    public function test()
    {
        try {
            RetryService::test();
            return ['test'];
        }catch (\Throwable $e){
            return [$e->getMessage()];
        }
    }
}