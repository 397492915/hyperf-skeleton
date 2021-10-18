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

Router::get('/favicon.ico', function () {
    return '';
});
