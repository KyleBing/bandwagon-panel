<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2018-05-8
 * Time: 15:15
 */

// 查看 Bandwagon 返回数据用

$apiKey = "这两个变量填自己的数据";
$VEID = 000;


$request = "https://api.64clouds.com/v1/".BandwagonHostCommand::$getLiveServiceInfo."?veid=".$VEID."&api_key=".$apiKey;

echo file_get_contents($request);



class BandwagonHostCommand{
    public static $start                = "start";
    public static $stop                 = "stop";
    public static $restart              = "restart";
    public static $kill                 = "kill";
    public static $getServiceInfo       = "getServiceInfo";
    public static $getLiveServiceInfo   = "getLiveServiceInfo";
    public static $getAvailableOS       = "getAvailableOS";
    public static $reinstallOS          = "reinstallOS";
    public static $resetRootPassword    = "resetRootPassword";
    public static $getUsageGraphs       = "getUsageGraphs";
    public static $getRawUsageStats     = "getRawUsageStats";
    public static $setHostname          = "setHostname";
    public static $setPTR               = "setPTR";
    public static $getSuspensionDetails = "getSuspensionDetails";
    public static $getRateLimitStatus   = "getRateLimitStatus";
}

?>