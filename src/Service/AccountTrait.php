<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : AccountTrait.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:14:13
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Woisk\Auth\Model\Account;
trait AccountTrait
{

    /**
     * 登录名字段类型转换
     * @param string $loginName
     * @return string
     */
    public function account_Trait_loginName($loginName)
    {
        switch ($loginName) {

            case filter_var($loginName, FILTER_VALIDATE_INT):
                return 'numeric';
                break;

            case filter_var($loginName, FILTER_VALIDATE_EMAIL):
                return 'email';
                break;

            default:
                return 'username';
        }
    }

    /**
     * 创建账号
     * @param array $data
     * @param string nikename 昵称
     * @param string username 用户名
     * #param string password 密码
     * @return mixed
     */
    public function account_Trait_create(array $data)
    {
        return Account::create([
            'nikename' => $data['nikename'],
            'username' => $data['username'],
            'password' => Hash::make($data['password'])
        ]);
    }


    /**
     * 密码错误次数
     * @param int $uid
     * @return mixed
     */
    public function account_Trait_login_error($uid)
    {
        $uid = Account::find($uid);
        $uid->login_error ++;
        return $uid->save();
    }

    /**
     * 密码错误次数清零
     * @param int $uid
     * @return mixed
     */
    public function account_Trait_login_error_clear($uid)
    {
        $uid = Account::find($uid);
        $uid->login_error = 0;
        return $uid->save();
    }

    /**
     * 是否存在
     * @param $key
     * @param $val
     * @return mixed
     */
    public function account_Trait_exists($key, $val)
    {
        return Account::where($key, '=', $val)->exists();

    }

    /**
     * 更新限制登录时间
     * @param int $uid
     * @param int $minute 时间/分钟
     * @return mixed
     */
    public function account_Trait_update_limit_time($uid,$minute)
    {
        $uid = Account::find($uid);
        $uid->updated_at = Carbon::parse('+'. $minute.'Minute')->toDateTimeString();
        $uid->save();
        return $uid;

    }

    /**
     * 获取单条数据
     * @param $key
     * @param $val
     * @return mixed
     */
    public function account_Trait_where_First($key, $val)
    {
        return Account::where($key, '=', $val)->first();
    }

    /**
     * uid登录次数+1
     * @param int $uid
     * @return mixed
     */
    public function account_Trait_login_count_add($uid)
    {
        $uid = Account::find($uid);
        $uid->login_count++;
        $uid->save();
        return $uid;

    }
}