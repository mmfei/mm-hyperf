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
namespace App\Exception\Handler;

use App\Utils\EnvUtil;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Codec\Json;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());
        $s = 'Internal Server Error.';
        $data = Json::encode([
            'code' => $throwable->getCode(),
            'message' => EnvUtil::isProd() ? $s : $throwable->getMessage(),
            'time' => time(),
            'data' => null,
        ], JSON_UNESCAPED_UNICODE);
        $string = new SwooleStream($data);
        return $response->withHeader('Server', 'Hyperf')->withHeader('content-type', 'application/json')->withStatus(500)->withBody($string);
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
