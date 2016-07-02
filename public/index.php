<?php

/**
 * 入口文件 index.php 加载初始化各项配置
 * @author: 喵了个咪  <wenzhenxi@vip.qq.com> 2016-2-1
 */

//默认的MVC配置库
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;

//在文件顶部加上 如下语句 作用是加载命名空间中的类
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Config\Adapter\Json as ConfigJson;
use Phalcon\Config\Adapter\Php as ConfigPhp;

use Phalcon\Logger;//当使用高级的时候需要用上

//使用loger的配置库 默认
use Phalcon\Logger\Adapter\File as FileAdapter;

//使用loger的配置库 高级
use Phalcon\Logger\Multiple as MultipleStream;
use Phalcon\Logger\Adapter\Stream as StreamAdapter;

//行格式化处理(这个是可以定义)
use Phalcon\Logger\Formatter\Line as LineFormatter;

//FirePHP 日志记录器(FirePHP 是利用Firebug console栏输出调试信息方便程序)
use Phalcon\Logger\Adapter\Firephp as Firephp;

//实现session 缓存
use Phalcon\Session\Adapter\Files as Session;

//数据库实例化
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {

    // 创建自动加载(AutoLoaders)实例
    $loader = new Loader();

    // 通过自动加载加载控制器(Controllers)
    $loader->registerDirs(array(
        // 控制器所在目录
        '../app/controllers/',
    ))->register();

    // 创建一个DI实例
    $di = new FactoryDefault();

    //开始测试
    //测试输出配置文件信息
    $ConfigIni  = new ConfigIni('../app/config/myini.ini');
    $ConfigJson = new ConfigJson('../app/config/config.json');
    $ConfigPhp  = new ConfigPhp('../app/config/config.php');
    echo $ConfigIni->database->host . '</br>';
    echo $ConfigJson->phalcon->baseuri . '</br>';
    echo $ConfigPhp->database->username . '</br>';

    // 初始化数据库连接 从配置项读取配置信息
    $di->set('db', function () use ($ConfigIni) {

        return new DbAdapter(array(
            "host"     => $ConfigIni->database->host,
            "username" => $ConfigIni->database->username,
            "password" => $ConfigIni->database->password,
            "dbname"   => $ConfigIni->database->dbname
        ));
    });

//实现loger
    $logger = new FileAdapter("../app/runtime/log/2016-07/20160702.log");  //初始化文件地址
//$logger->log("This is a message");                               //写入普通log
//$logger->log("This is an error", \Phalcon\Logger::ERROR);         //写入error信息
//$logger->error("This is another error");                          //于上一句同义

//高性能--更快的速度,每个地方执行log都要去写入到文件里面的话，文件IO就会非常频繁，因此可以使用事务处理
// 开启事务
//$logger->begin();
//// 添加消息
//$logger->alert("This is an alert");
//$logger->error("This is another error");
////  保存消息到文件中
//$logger->commit();


//实现更高级的loger
    $logger = new MultipleStream();

// 修改日志格式
    $formatter = new LineFormatter("[%date%] - [%message%]");
    $logger->setFormatter($formatter);
//
    $logger->push(new FileAdapter('test.log'));
    $logger->push(new StreamAdapter('php://stdout'));
//$logger->log("This is a message");
//$logger->log("This is an error", Logger::ERROR);
//$logger->error("This is another error");

//$logger = new Firephp("");
//$logger->log("This is a message");
//$logger->log("This is an error", Logger::ERROR);
//$logger->error("This is another error");

//实例化session并且开始 赋值给DI实例 方便在控制器中调用
    $di->setShared('session', function () {
        $session = new Session();
        $session->start();
        return $session;
    });


    //自动加载设置 MVC :
    $loader->registerDirs(array(
        // 控制器所在目录
        '../app/controllers/',
        //model所在目录
        '../app/models/',
    ))->register();

    //测试结束

    // 实例化View 赋值给DI的view
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // 处理请求
    $application = new Application($di);
    // 输出请求类容
    echo $application->handle()->getContent();



} catch (\Exception $e){
    // 异常处理
    echo "PhalconException: ", $e->getMessage();
}
