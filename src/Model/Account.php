<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : Account.php
 *----------------------------------------------------------------------
 *| 描 述 : 账号数据表
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/2/27 Time:19:18
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Model;


use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends User implements JWTSubject
{
    use Notifiable;
    protected $connection = 'account';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $table = 'account';
    protected $primaryKey ='uid';
    protected $rememberTokenName = false;

    protected $fillable = [
        'numeric',
        'username',
        'email',
        'phone',
        'password',
        'nikename',
        'state',
        'login_count',
        'login_error'
    ];

    protected $hidden = [
        'password',
        'email',
        'phone',
        'username',
        'numeric',
        'state',
        'created_at',
        'updated_at',
        'login_count',
        'login_error'

    ];

}