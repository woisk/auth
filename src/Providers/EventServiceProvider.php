<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : EventServiceProvider.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:14:19
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Woisk\Auth\Http\Events\RegistrEvent' =>[
            'Woisk\Auth\Http\Listeners\RegistrLog'
        ],

        'Woisk\Auth\Http\Events\LoginEvent' =>[
            'Woisk\Auth\Http\Listeners\LoginLog'
        ],

        'Woisk\Auth\Http\Events\LoginFailsEvent' =>[
            'Woisk\Auth\Http\Listeners\LoginFailsLog'
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }

}