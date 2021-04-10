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
use App\Utils\Log;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MyHttpMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $code = 0;
            $response = $handler->handle($request);
            $data = Json::decode($response->getBody()->getContents());
        } catch (MyHttpApiException $e) {
            $code = $e->getCode();
            $data = $e->getMessage();
        }
        $content = [
            'code' => $code,
            'data' => $data,
            'time' => time(),
        ];
        $response1 = Context::get(PsrResponseInterface::class);
        $response1 = $response1->withAddedHeader('content-type', 'application/json')->withBody(new SwooleStream(Json::encode($content)))->withStatus(200);
        return \Hyperf\Utils\Context::set(ResponseInterface::class, $response1);
    }
}
