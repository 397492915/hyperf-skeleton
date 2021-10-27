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
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'POST', 'HEAD'], '/index/test1', 'App\Controller\IndexController@test1');
Router::addRoute(['GET', 'POST', 'HEAD'], '/index/test2', 'App\Controller\IndexController@test2');
Router::addRoute(['GET', 'POST', 'HEAD'], '/index/test3', 'App\Controller\IndexController@test3');
Router::addRoute(['GET', 'POST', 'HEAD'], '/index/test4', 'App\Controller\IndexController@test4');
Router::addRoute(['GET', 'POST', 'HEAD'], '/index/test5', 'App\Controller\IndexController@test5');
Router::addRoute(['GET', 'POST', 'HEAD'], '/index/test6', 'App\Controller\IndexController@test6');
Router::addRoute(['GET', 'POST', 'HEAD'], '/rate-limit/test', 'App\Controller\RateLimitController@test');
Router::addRoute(['GET', 'POST', 'HEAD'], '/retry/test', 'App\Controller\RetryController@test');
Router::addRoute(['GET', 'POST', 'HEAD'], '/circuit/test', 'App\Controller\CircuitController@test');

Router::get('/favicon.ico', function () {
    return '';
});
