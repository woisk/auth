<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : CheckController.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:16:28
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckController extends BaseController
{
    /**
     * 检查字段数据是否存在
     * @param Request $request
     * @return $this
     */
    public function check(Request $request)
    {

        switch ($request) {
            case $request->has('username'):
                return $this->username($request->all());
                break;
            case $request->has('numeric'):
                return $this->numeric($request->all());
                break;
            case $request->has('email'):
                return $this->email($request->all());
                break;
            case $request->has('phone'):
                return $this->phone($request->all());
                break;
            default:
                return $this->res(422, '请核对查询参数');
        }
    }

    /**
     * 用户名
     * @param array $data
     * @return mixed
     */
    public function username(array $data)
    {
        $validator = Validator::make($data, [
            'username' => 'required|regex:/^[a-zA-Z][-_a-zA-Z0-9]+$/|min:5|max:20|unique:account.account',
        ]);

        if ($validator->fails()) {
            return $this->res(422, $validator->errors()->first());
        }

        return $this->res(200, '用户名可以使用');

    }
    /**
     * 用户名
     * @param array $data
     * @return mixed
     */
    public function numeric(array $data)
    {
        //429 496 7295
        $validator = Validator::make($data, [
            'numeric' => 'required|unique:account.account|min:5|max:18',
        ]);

        if ($validator->fails()) {
            return $this->res(422, $validator->errors()->first());
        }

        return $this->res(200, '数字账号可以使用');


    }


    /**
     * 邮箱地址
     * @param array $data
     * @return mixed
     */
    public function email(array $data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email|string|unique:account.account|min:5|max:60',
        ]);

        if ($validator->fails()) {
            return $this->res(422, $validator->errors()->first());
        }
        return $this->res(200, '邮箱可以使用');
    }

    /**
     * 手机号码
     * @param array $data
     * @return mixed
     */
    public function phone(array $data)
    {
        $validator = Validator::make($data, [
            'phone' => 'required|string|unique:account.account|min:11|max:11',
        ]);

        if ($validator->fails()) {
            return $this->res(422, $validator->errors()->first());
        }
        return $this->res(200, '手机号码可以使用');
    }
}
