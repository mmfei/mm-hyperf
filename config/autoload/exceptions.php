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
return [
    'handler' => [
        // 这里对应您当前的 Server 名称
        'http' => [
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            \App\Exception\Handler\MyValidationExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
            //            \Hyperf\ExceptionHandler\Handler\WhoopsExceptionHandler::class,
        ],
    ],
];
