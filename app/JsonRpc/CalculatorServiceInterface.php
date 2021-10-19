<?php


namespace App\JsonRpc;

/**
 * 消费者和服务提供者共同的接口
 * Interface CalculatorServiceInterface
 * @package App\JsonRpc
 */
interface CalculatorServiceInterface
{
    public function add(int $a, int $b);
}