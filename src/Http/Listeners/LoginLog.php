<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : LoginLog.phpphp
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:17:32
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Listeners;


use Woisk\Auth\Http\Events\LoginEvent;
use Woisk\Auth\Service\LoginLogTrait;

class LoginLog
{
    use LoginLogTrait;

    public function handle(LoginEvent $event)
    {
        return $this->login_Trait_Log($event->uid, $event->loginname);
    }
}