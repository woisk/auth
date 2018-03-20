<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : RegistrLog.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:14:55
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Listeners;


use Woisk\Auth\Http\Events\RegistrEvent;
use Woisk\Auth\Service\RegistrLogTrait;

class RegistrLog
{
    use RegistrLogTrait;

    public function handle(RegistrEvent $event)
    {
        return $this->registr_Trait_log($event->uid);
    }
}