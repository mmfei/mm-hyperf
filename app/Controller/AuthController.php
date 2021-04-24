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
use App\Model\UserAuth;
use App\Request\AuthRegistRequest;
use Hyperf\HttpServer\Annotation\AutoController;
use Qbhy\HyperfAuth\Annotation\Auth;

/**
 * Class AuthController.
 * @AutoController
 */
class AuthController extends NeedLoginController
{
    const AUTH_TYPE = 'jwt';
    public function index()
    {
        return $this->response->raw('Hello Hyperf!');
    }

    public function regist(AuthRegistRequest $authRegistRequest)
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        if ($email && $password) {
            $user = User::where(['name' => $email])->first();
            if($user) {
                throw new \ErrorException($this->translator->trans('error_trans.has_exists' , ['Name' => $email]) , ExceptionCode::IS_EXISTS);
            }
            $result = User::insertOrIgnore(['name' => $email, 'nickname' => $email]);
            $user_id = 0;
            $user = null;
            if ($result) {
                $user = User::where(['name' => $email, 'nickname' => $email])->first();
                if ($user) {
                    $user_id = (int) ($user->user_id);
                }
            } else {
                $user = User::where(['name' => $email])->first();
                if ($user && $user->email == $email) {
                    $user_id = (int) ($user->user_id);
                }
            }
            if ($user_id > 0) {
                $user_auth = new UserAuth();
                $user_auth->user_id = $user->user_id;
                $user_auth->email = $email;
                $user_auth->password = $password;
                UserAuth::updateOrInsert(['user_id' => $user_id], ['email' => $email, 'password' => $password, 'token' => '']);
                $token = $this->auth->guard(self::AUTH_TYPE)->login($user_auth);
                $user_auth = UserAuth::find($user->user_id);
                $user_auth->token = $token;
                $user_auth->save();

                return $token;
            }
        }
        return null;
    }

    public function login()
    {
        $return = [];
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        if ($email && $password) {
            /** @var UserAuth $user_auth */
            $user_auth = UserAuth::query()->where(['email' => $email, 'password' => $password])->first();
            if ($user_auth) {
                $auth = UserAuth::retrieveById($user_auth->user_id);

                $return = [
                    'token' => $this->auth->guard(self::AUTH_TYPE)->login($auth),
                    'id' => $auth->getId(),
                ];
            }
        }
        return $return;
    }

    public function logout()
    {
        $this->auth->guard(self::AUTH_TYPE)->logout();
        return 'logout ok';
    }

    /**
     * 使用 Auth 注解可以保证该方法必须通过某个 guard 的授权，支持同时传多个 guard，不传参数使用默认 guard.
     * @Auth("jwt")
     * @return string
     */
    public function user()
    {
        $user_auth = $this->auth->guard(self::AUTH_TYPE)->user();
        $return = [];
        if($user_auth) {
            $return = User::find($user_auth->getId());
        }
        return $return;
    }
}
