<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : RegistrLogTrait.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:15:29
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Service;


use Carbon\Carbon;
use Woisk\Auth\Model\RegLog;

trait RegistrLogTrait
{
    use AgentTrait;

    /**
     * 账号注册记录
     * @param $request
     * @param $uid
     * @return mixed
     */
    public function registr_Trait_log($uid)
    {
        return RegLog::create([
            'uid' => $uid,
            'ip' => request()->getClientIp(),
            'devices' => $this->agent_Trait_device_type(),
            'device_os' => $this->agent_Trait_os(),
            'time' => Carbon::create()
        ]);
    }

}