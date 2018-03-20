<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : LoginFailsLog.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:17:32
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Listeners;


use Woisk\Auth\Http\Events\LoginFailsEvent;
use Woisk\Auth\Service\LoginFailsLogTrait;

class LoginFailsLog
{
    use LoginFailsLogTrait;
    public function handle(LoginFailsEvent $event)
    {
        return $this->loginFails_Trait_Log($event->uid,$event->loginname);
    }
}