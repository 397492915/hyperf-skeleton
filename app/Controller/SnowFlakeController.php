<?php

namespace App\Controller;

use Hyperf\Snowflake\IdGeneratorInterface;
use Hyperf\Utils\ApplicationContext;

/**
 * 微服务-重试
 * Class RetryController
 * @package App\Controller
 */
class SnowFlakeController
{
    /**
     * @return string[]
     */
    public function test()
    {
        $container = ApplicationContext::getContainer();
        $idGenerator = $container->get(IdGeneratorInterface::class);
        //定制$meta，设置workerId等
        $meta = $idGenerator->getMetaGenerator()->generate();
        $dataCenterId = 0;
        $workId = 10;
        $rand = mt_rand(100,999);
        $meta->setDataCenterId($dataCenterId);
        $meta->setWorkerId($workId);
        $meta->setSequence($rand);
        $timestamp = $meta->getTimestamp();
        $beginTimestamp = $meta->getBeginTimestamp();
        $timeMinus = $timestamp - $beginTimestamp;
        $selfId = ($timeMinus << 22) + ($dataCenterId << 17) + ($workId << 12)  + $rand;
        $id = $idGenerator->generate();
        return [
            'id1' => $id, //两个id不一致，不清楚为什么，手算的是id2
            'id2' => $selfId,
            'timestamp' => $timestamp,
            'beginTimestamp' => $beginTimestamp,
            'meta' => (array)$meta,
        ];
    }
}