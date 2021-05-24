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

use App\Constants\ExceptionCode;
use App\Model\User;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Qbhy\HyperfAuth\Annotation\Auth;
use Qbhy\HyperfAuth\AuthManager;

/**
 * Class NeedLoginController.
 * @AutoController
 */
class NeedLoginController extends AbstractController
{
    /**
     * @Inject
     * @var AuthManager
     */
    protected $auth;

    /**
     * @Cacheable(prefix="auth", group="co")
     */
    protected function currentUser()
    {
        $user_auth = $this->auth->guard('jwt')->user();
        if ($user_auth) {
            return User::find((int) $user_auth->getId());
        }
        return null;
    }

    protected function getCurrentUser($is_need_login = false)
    {
        $user = self::currentUser();
        if ($is_need_login && empty($user)) {
            throw new \OAuthException($this->translator->trans('error_trans.need_auth'), ExceptionCode::NEED_AUTH);
        }
        return $user;
    }
}
