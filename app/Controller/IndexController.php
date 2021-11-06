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

use App\Amqp\Producer\DemoProducer;
use App\JsonRpc\CalculatorServiceInterface;
use App\JsonRpc\TestService;
use App\JsonRpc\TestServiceInterface;
use App\Utils\Log;
use Hyperf\Amqp\Producer;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Hyperf\Utils\Coroutine;
use Hyperf\Utils\Exception\ParallelExecutionException;
use Hyperf\Utils\Parallel;

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
     * Channel特性，协程间通信
     * http://127.0.0.1:9501/index/test
     * @return mixed
     */
    public function test()
    {
        $channel = new \Swoole\Coroutine\Channel();
        co(function () use ($channel) {
            $channel->push('data');
        });
        return $channel->pop();
    }

    /**
     * test WaitGroup
     * http://127.0.0.1:9501/index/test1
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
            sleep(3);
            Log::get()->info('B');
            // 计数器减一
            $wg->done();
        });
        // 等待协程 1 和协程 2 运行完成（最后一个协程执行完毕后，会push消息，pop拿到数据停止阻塞）
        $wg->wait();
        Log::get()->info('C');
        return [];
    }

    /**
     * test Parallel 特性
     * http://127.0.0.1:9501/index/test2
     */
    public function test2()
    {
        //每次执行最多5个协程
        $parallel = new Parallel(5);
        $parallel->add(function () {
            sleep(1);
            return Coroutine::id();
        });
        $parallel->add(function () {
            sleep(3);
            return Coroutine::id();
        });

        try{
            // $results 结果为 [1, 2]
            $results = $parallel->wait();
            Log::get()->info(json_encode($results));
            return $results;
        } catch(ParallelExecutionException $e){
            // $e->getResults() 获取协程中的返回值。
            // $e->getThrowables() 获取协程中出现的异常。
        }
    }

    /**
     * test Parallel 特性
     * http://127.0.0.1:9501/index/test3
     */
    public function test3()
    {
        return parallel([
            function () {
                sleep(1);
                return Coroutine::id();
            },
            function () {
                sleep(3);
                return Coroutine::id();
            }
        ]);
    }

    /**
     * 服务发现test
     * @param CalculatorServiceInterface $calculatorService
     * @return mixed
     */
    public function test4(CalculatorServiceInterface $calculatorService)
    {
        Log::get()->info(Coroutine::id());
        return $calculatorService->add(2,5);
    }

    /**
     * 服务发现test
     * @param TestServiceInterface $testService
     * @return mixed
     */
    public function test5(TestServiceInterface $testService)
    {
        Log::get()->info(Coroutine::id());
        return $testService->add(2,5);
    }

    /**
     * amqp test
     * @return bool
     */
    public function test6()
    {
        $message = new DemoProducer([1,2,3,'a'=>'b']);
        $producer = ApplicationContext::getContainer()->get(Producer::class);
        return $producer->produce($message);
    }
}
