<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : LoginFailsEvent.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:17:19
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Http\Events;


class LoginFailsEvent
{
    public $uid;

    public $loginname;

    public function __construct($uid,$loginname)
    {
        $this->uid = $uid;
        $this->loginname = $loginname;
    }
}