<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : LoginFailsLogTrait.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:17:36
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Service;


use Carbon\Carbon;
use Woisk\Auth\Model\LoginFailLog;

trait LoginFailsLogTrait
{

    use AgentTrait;

    public function loginFails_Trait_Log($uid, $loginname)
    {
        return LoginFailLog::create([
            'uid' => $uid,
            'ip' => request()->getClientIp(),
            'devices' => $this->agent_Trait_device_type(),
            'device_os' => $this->agent_Trait_os(),
            'account_type' => $loginname,
            'time' => Carbon::create()
        ]);

    }
}