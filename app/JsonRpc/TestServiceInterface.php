<?php


namespace App\JsonRpc;

/**
 * 消费者和服务提供者共同的接口
 * Interface TestServiceInterface
 * @package App\JsonRpc
 */
Interface TestServiceInterface
{
    public function add(int $a, int $b);
}