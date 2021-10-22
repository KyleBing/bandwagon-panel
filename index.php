
<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2018-05-8
 * Time: 15:15
 */

date_default_timezone_set("Asia/Shanghai");

$apiKey = "这两个变量填自己的数据";
$VEID = 000;


$request = "https://api.64clouds.com/v1/".BandwagonHostCommand::$getLiveServiceInfo."?veid=".$VEID."&api_key=".$apiKey;

$info =  json_decode(file_get_contents($request));

// 存储单位转换
$convertG = 1024 * 1024 * 1024;
$convertM = 1024 * 1024;

$multi = $info -> monthly_data_multiplier;

// 流量数据
$dataUsage = round(($info -> data_counter * $multi / $convertG),1);
$dataFull = round(($info -> plan_monthly_data * $multi / $convertG),1);
$dataRemain = $dataFull - $dataUsage;
$dataPercentage = $dataRemain / $dataFull;

// 硬盘数据
$diskUsage = round(($info -> ve_used_disk_space_b / $convertG),1);
$diskFull = round(($info -> plan_disk / $convertG),1);
$diskRemain = $diskFull - $diskUsage;
$diskPercentage = $diskRemain / $diskFull;

// 内存数据
$memLeft = round(($info -> mem_available_kb / 1024),0);
$memFull = round(($info -> plan_ram / $convertM),0);
$memUsage = $memFull - $memLeft;
$memPercentage = $memLeft / $memFull;

$output = round($dataUsage,1)."G / ".round($dataMonth,1)."G";



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

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="VPS.png">
    <link rel="shortcut icon" href="VPS.png" type="image/png">
    <script src="../../lib/js/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="vps.css">
    <link rel="stylesheet" href="../../lib/css/reset.css">
    <title>VPS</title>
</head>
<body>
<div class="container">
    <div class="chart clearfix">
        <div class="chart-item">
            <div class="chart-pic blue">
                <div class="chart-fill" style="height: <?php echo $diskPercentage * 100?>%"></div>
            </div>
            <div class="label">硬盘</div>
            <div class="capacity"><?php echo $diskRemain."/".$diskFull."G" ?></div>
        </div>
        <div class="chart-item">
            <div class="chart-pic orange">
                <div class="chart-fill" style="height: <?php echo $memPercentage * 100?>%"></div>
            </div>
            <div class="label">内存</div>
            <div class="capacity"><?php echo $memLeft."/".$memFull."M" ?></div>
        </div>
        <div class="chart-item">
            <div class="chart-pic green">
                <div class="chart-fill" style="height: <?php echo $dataPercentage * 100?>%"></div>
            </div>
            <div class="label">流量</div>
            <div class="capacity"><?php echo $dataRemain."/".$dataFull."G" ?></div>
        </div>

    </div>
    <div class="detail">
        <ul>
            <?php
            print('<li><span class="vps-key">流量重置时间</span><span class="vps-value">'.date("m月d日",$info -> data_next_reset).'</span></li>
                    <li><span class="vps-key">IP</span><span class="vps-value">'.(count($info -> ip_addresses)>0? $info -> ip_addresses[0] : "").'</span></li>
                    <li><span class="vps-key">状态</span><span class="vps-value">'.$info -> ve_status.'</span></li>
                    <li><span class="vps-key">虚拟机类型</span><span class="vps-value">'.$info -> vm_type.'</span></li>
                    <li><span class="vps-key">Mac 地址</span><span class="vps-value">'.$info -> ve_mac1.'</span></li>
                    <li><span class="vps-key">操作系统</span><span class="vps-value">'.$info -> os.'</span></li>
                    <li><span class="vps-key">主机地址</span><span class="vps-value">'.$info -> node_location.'</span></li>
                    <li><span class="vps-key">地址编号</span><span class="vps-value">'.$info -> node_location_id.'</span></li>
                    <li><span class="vps-key">数据中心</span><span class="vps-value">'.$info -> node_datacenter.'</span></li>');
            ?>
        </ul>
    </div>
</div>


<script>
window.onload = () => {
    document.body.style.height = innerHeight + 'px';
}
</script>
</body>
</html>
