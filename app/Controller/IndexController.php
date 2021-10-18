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
        //添加两个携程
        $wg->add(2);
        // 创建协程 1
        co(function () use ($wg) {
            // some code
            sleep(1);
            Log::get()->info('A');
            // 计数器减一
            $wg->done();
        });
        // 创建协程 2
        co(function () use ($wg) {
            // some code
            sleep(1);
            Log::get()->info('B');
            // 计数器减一
            $wg->done();
        });
        // 等待协程 1 和协程 2 运行完成（最后一个协程执行完毕后，会push消息，pop拿到数据停止阻塞）
        $wg->wait();
        Log::get()->info('C');
        return [];
    }
}
