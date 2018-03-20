<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : RegController.php
 *----------------------------------------------------------------------
 *| 描 述 :  注册账号
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/2/28 Time:20:33
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Woisk\Auth\Http\Events\RegistrEvent;
use Woisk\Auth\Service\AccountTrait;

class RegController extends BaseController
{
    use AccountTrait;

    /**
     * 注册账号参数验证
     * @param array $data
     * @return mixed
     */
    protected function registr_Validator(array $data)
    {
        return Validator::make($data, [
            'nikename' => 'required|string|min:2|max:20',
            'username' => 'required|regex:/^[a-zA-Z][-_a-zA-Z0-9]+$/|min:5|max:20|unique:account.account',
            'password' => 'required|string|min:6|max:20'
        ]);
    }


    /**
     * 注册账号
     * @param Request $request
     * @return mixed
     */
    public function registr(Request $request)
    {
        //验证参数
        $validator = $this->registr_Validator($request->all());
        if ($validator->fails()) {
            return $this->res(422, $validator->errors()->first());
        }

        //创建账号
        $user = $this->account_Trait_create($request->all());

        //注册记录
         event(new RegistrEvent($user->uid));

        //注册成功 重定向登录
        return $this->res(200,'注册成功');


    }


}