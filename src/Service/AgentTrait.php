<?php
/**
 *----------------------------------------------------------------------
 *| 文件名 : AgentTrait.php
 *----------------------------------------------------------------------
 *| 描 述 :
 *----------------------------------------------------------------------
 *| Author: 栗枫林  Date:2018/3/8 Time:15:32
 *----------------------------------------------------------------------
 *| Email : bolelin@126.com  QQ: 364956690
 *----------------------------------------------------------------------
 */

namespace Woisk\Auth\Service;


use Jenssegers\Agent\Agent;

trait AgentTrait
{
    /**
     * 操作系统.版本
     * @return string
     */
    public function agent_Trait_os()
    {
        $agent = new Agent();
        return $agent->platform() . $agent->version($agent->platform());
    }

    /**
     * 设备名称
     * @return string
     */
    public function agent_Trait_device_type()
    {
        $agent = new Agent();

        switch ($agent) {
            case $agent->isDesktop():
                return 'Desktop';
                break;
            case $agent->isTablet():
                return 'Tablet';
                break;
            case $agent->isPhone():
                return 'Phone';
                break;
            default:
                return 'Un';
        }
    }
}