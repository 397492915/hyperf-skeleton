<?php
declare(strict_types=1);
namespace App\Service;

use App\Utils\Log;
use Hyperf\Retry\Annotation\Retry;
/**
 * 重试适用于所有方法，不仅仅是controller方法，还可以是service方法
 */
class RetryService
{
    /**
     * @Retry(maxAttempts=3)
     * @throws \Exception
     */
    public static function test()
    {
        Log::get()->info('RetryService::test');
        throw new \Exception('retry');
    }
}