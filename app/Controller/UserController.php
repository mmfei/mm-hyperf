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

use Hyperf\HttpServer\Annotation\AutoController;

/**
 * Class UserController.
 * @AutoController
 */
class UserController extends NeedLoginController
{
    public function index()
    {
        return $this->currentUser();
    }

    public function my()
    {
        throw new \App\Exception\Handler\MyHttpApiException('test1', 999);
    }
    public function success() {
        return ['a' => 'success',];
    }
}
