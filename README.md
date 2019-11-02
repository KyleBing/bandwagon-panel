# Bandwagon Host 主机信息展示工具

> 主旨在方便用户查看 Bandwagon Host 信息

例子地址： [http://kylebing.cn/tools/vps/](http://kylebing.cn/tools/vps/)


## 样子

电脑端

<img src="https://github.com/KyleBing/bandwagon-panel/blob/master/github/bandwagon_panel_pc.png?raw=true" width="">

移动端

<img src="https://github.com/KyleBing/bandwagon-panel/blob/master/github/bandwagon_panel_phone.png?raw=true" width="400"> 

## 需要做的

> **先决条件**： 主机已经安装并运行了 web 服务器，并可以运行 php 程序

打开你的主机控制面板，在左侧菜单栏中，有个【API】选项，点进去，会看到
`VEID` 和 `API KEY`  两个参数，`API KEY` 需要点击一下才能看到。

**注意**： 任何时候都不要告诉别人这两个值，有了这两个值就可以任何操控你的主机了
这也是为什么把这两个值直接写在服务端的原因。

获取到这两个值以后，替换 `index.php` 和 `getinfo.php` 文件中的这两个值，保存就可以了。

```php
$apiKey = "12345";
$VEID = 12345;
```

```bash
├── README.md		  // 本说明文档
├── VPS.png			  // logo
├── _reset.scss		// css reset
├── getInfo.php		// 用于测试用的，可以显示全部主机信息
├── github			  // 盛放 github 中用到的图片
├── index.php		  // 主页，主要文件
├── vps.css			  // 样式文件
├── vps.css.map		// 样式文件 map
└── vps.scss		  // 样式源文件
```
