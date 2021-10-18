<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Utils\Log;
use Hyperf\Utils\Context;
use Hyperf\Utils\Coroutine;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'co' => Coroutine::inCoroutine()
        ];
    }

    /**
     * test WaitGroup
     */
    public function test1()
    {
        $wg = new \Hyperf\Utils\WaitGroup();
        // 创建协程 A
        co(function () use ($wg) {
            // some code
            // 计数器减一

           //curl
            Log::get()->info('A');
            $wg->done();
        });
        // 创建协程 B
        co(function () use ($wg) {
            // some code
            // 计数器减一
            //curl
            Log::get()->info('B');
            $wg->done();
        });
        // 等待协程 A 和协程 B 运行完成
        $wg->wait();
        Log::get()->info('C');
        return [];
    }
}
