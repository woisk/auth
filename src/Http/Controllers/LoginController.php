<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : LoginController.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:17:06
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Woisk\Auth\Http\Events\LoginEvent;
use Woisk\Auth\Http\Events\LoginFailsEvent;
use Woisk\Auth\Service\AccountTrait;

class LoginController extends BaseController
{
    use AccountTrait;

    /**
     * 登录参数验证
     * @param array $data
     * @return mixed
     */
    protected function login_validator(array $data)
    {
        return Validator::make($data, [
            'login_name' => 'required|string|min:5|max:40',
            'password' => 'required|string|min:6|max:40'
        ]);
    }

    /**
     * 账号登录
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //验证参数
        $validator = $this->login_validator($request->all());
        if ($validator->fails()) {
            return $this->res(422, $validator->errors()->first());
        }

        //登录名转换
        $loginName = $this->account_Trait_loginName($request->input('login_name'));

        //验证账号
        $user = $this->account_Trait_where_First($loginName, $request->input('login_name'));
        if (empty($user)) {
            return $this->res(401, '账号不正确');
        }

        //禁止登录的时间
        $user_time = $user->updated_at;
        $day_time = Carbon::now();

        if ($user_time->gt($day_time)) {
            $time = $user_time->diffForHumans(null, true);
            return $this->res(401, '输错密码次数过多,请等' . $time . '后再来登录');
        }

        //验证密码
        $password = Hash::check($request->input('password'), $user->password);
        if (!$password) {

            //验证登录错误次数
            if ($user->login_error >= 4) {

                //登录失败
                event(new LoginFailsEvent($user->uid, $loginName));

                //记录密码错误次数
                $this->account_Trait_login_error($user->uid);

                //账号禁用时间 30分钟
                $this->account_Trait_update_limit_time($user->uid, 30);

                return $this->res(401, '你输错密码次数过多，请等30分钟再来试试');

            } elseif ($user->login_error >= 3 && $user->login_error <= 4) {

                //登录失败
                event(new LoginFailsEvent($user->uid, $loginName));

                //记录密码错误次数
                $this->account_Trait_login_error($user->uid);

                return $this->res(401, '你已经输错密码多次，请认真核对密码');
            }

            //登录失败
            event(new LoginFailsEvent($user->uid, $loginName));

            //记录密码错误次数
            $this->account_Trait_login_error($user->uid);

            return $this->res(401, '密码不正确');
        }


        //清除密码错误次数 0
        $this->account_Trait_login_error_clear($user->uid);

        //验证状态
        switch ($user->state) {
            case '0':
                return $this->res(200, '账号已冻结');
                break;
            case '2':
                return $this->res(200, '账号已停用');
                break;
            case '3':
                return $this->res(200, '账号已注销');
                break;
        }


        //登录次数
        $this->account_Trait_login_count_add($user->uid);

        //登录记录
        event(new LoginEvent($user->uid, $loginName));

        //登录成功 返回Token
        return $this->res(200, '登录成功', [
            'nikename' => $user->nikename,
            'token' => auth()->login($user),
            'login_state' => 1
        ])->withCookie('login_state', 1)
            ->withCookie('token', auth()->login($user))
            ->withCookie('nikename', $user->nikename);


    }
}