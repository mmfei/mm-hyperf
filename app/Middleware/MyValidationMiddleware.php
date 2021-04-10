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
namespace App\Middleware;

use App\Exception\MyHttpApiException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Context;
use Hyperf\Validation\Middleware\ValidationMiddleware;
use Hyperf\Validation\ValidationException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MyValidationMiddleware extends ValidationMiddleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        try {
            return parent::process($request , $handler);
        } catch (ValidationException $e) {
            $content = [
                'code' => 400,
                'data' => $e->validator->getMessageBag()->first(),
                'time' => time(),
            ];
            $response1 = Context::get(PsrResponseInterface::class);
            $response1 = $response1->withAddedHeader('content-type', 'application/json')->withBody(new SwooleStream(Json::encode($content)))->withStatus(200);
            return \Hyperf\Utils\Context::set(ResponseInterface::class, $response1);
        }
    }
}
