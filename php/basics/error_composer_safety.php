<?php

// include "..//Library/WebServer/Documents/202503php/php/basics/helpers_2.php"; //如果失败，会抛出一个 warning ， 但是脚本会继续执行
// require "..//Library/WebServer/Documents/202503php/php/basics/helpers_2.php"; //如果失败，会抛出一个 fatal error ， 脚本会停止执行

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers_2.php';

//定义一个执行命令
//PHP链接PDO。数据库
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//设置错误处理模式。：如果执行 SQL 出错，就抛出异常（Exception）
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//设置默认取回数据的格式。默认关联数组。fetch_assoc
    PDO::ATTR_EMULATE_PREPARES => false,//设置本地模拟。false表示不模拟。防止SQL注入攻击。
];

try {
    //创建 PDO 链接实例
    $pdo = new PDO("mysql:host=localhost;dbname=school;charset=utf8", "root", "root", $options);

    echo "数据库连接成功";
}
    catch (PDOException $e) {
    //如果连接失败，PDO 会抛出 PDOException 异常
    // echo "数据库连接失败:" . $e->getMessage();

    echoWithBr("服务器网络异常，稍后再试");
}
    finally {
        // 这里是无论是否发生异常都会执行的代码
        echoWithBr("数据库连接结束");
        // exit(0);
    }

    //使用 throw 语句抛出异常
    //用过了
    //if (!isset($_POST['token'])) {
    //    throw new Exception("没有权限访问该页面", 403);
    //}