<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : LoginFailLog.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/5 Time:18:15
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Model;


use Illuminate\Database\Eloquent\Model;

class LoginFailLog extends Model
{

    protected $table = 'account_login_fail_log';
    protected $connection = 'account';
    public $timestamps = false ;

    protected $fillable = [
        'uid',
        'ip',
        'devices',
        'device_os',
        'account_type',
        'time'

    ];

}