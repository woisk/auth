<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : UserServiceProvider.php
 *----------------------------------------------------------------------
 *| 描 述 : 账号验证服务
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/2/27 Time:17:13
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 启动初始化
     */
    public function boot()
    {

        //加载数据库配置
        $this->setConfig();

        //初始化加载路由文件
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }


    /**
     * 初始化数据库配置
     */
    public function setConfig()
    {
        //配置文件的名称
        $configFileName = 'authConfig';

        //数据库 Connections 名称
        $connectionsName = 'account';

        config([
            'database.connections.'.$connectionsName.'.driver'=>config($configFileName.'.database.driver'),
            'database.connections.'.$connectionsName.'.host'=>config($configFileName.'.database.host'),
            'database.connections.'.$connectionsName.'.port'=>config($configFileName.'.database.port'),
            'database.connections.'.$connectionsName.'.database'=>config($configFileName.'.database.database'),
            'database.connections.'.$connectionsName.'.username'=>config($configFileName.'.database.username'),
            'database.connections.'.$connectionsName.'.password'=>config($configFileName.'.database.password'),
            'database.connections.'.$connectionsName.'.unix_socket'=>config($configFileName.'.database.unix_socket'),
            'database.connections.'.$connectionsName.'.charset'=>config($configFileName.'.database.charset'),
            'database.connections.'.$connectionsName.'.collation'=>config($configFileName.'.database.collation'),
            'database.connections.'.$connectionsName.'.prefix'=>config($configFileName.'.database.prefix'),
            'database.connections.'.$connectionsName.'.strict'=>config($configFileName.'.database.strict'),
            'database.connections.'.$connectionsName.'.engine'=>config($configFileName.'.database.engine'),
        ]);
    }

    /**
     * 注册/绑定容器服务
     */
    public function register()
    {

    }
}