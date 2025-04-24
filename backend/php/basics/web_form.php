<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers_2.php';

echoHr();

// 能这么实现, 但是不要这么做, 我们一般会使用 throw 抛出异常或者是框架的错误处理机制
//header("HTTP/1.1 404 Not Found");
//echo "<h1>404 Not Found</h1>";
//exit;

header('Content-Type: text/html; charset=utf-8');

printRWithBr($_GET);
echoHr();
printRWithBr($_REQUEST);
echoHr();
printRWithBr($_COOKIE);

// 如果你的 session 没有开启，访问 session 可能会报错
session_start();
printRWithBr($_SESSION);

//echoHr();
//printRWithBr($_SERVER);

echoHr();
printRWithBr($_FILES);

// ⚠️ 始终要记住用户输入的任何内容都是不可信的, 都要进行验证和过滤

// ⚠️ 大家自己去搜索了解以下什么是 CSRF 攻击, 什么是 XSS 攻击, 什么是 SQL 注入攻击, 什么是文件上传漏洞
// 1. CSRF（跨站请求伪造）攻击Cross-Site Request Forgery原理： 利用用户已登录的身份，诱导用户在不知情的情况下发送请求到目标网站，从而执行操作（如转账、改密码等）。
//举例：用户登录了某个银行网站后没有退出，攻击者诱导他点击一个恶意链接，这个链接发出的是银行网站的转账请求，银行服务器以为是用户主动的操作，从而执行了转账。

//2. XSS（跨站脚本攻击 全称：Cross-Site Scripting原理： 攻击者向网页中注入恶意脚本，当其他用户浏览网页时，这段脚本会在用户浏览器中执行，从而盗取 Cookie、控制用户操作等。
//举例：用户在论坛发帖内容中插入一段 <script>alert(document.cookie)</script>，其他用户浏览时弹出他们的 cookie。

//SQL 注入攻击全称：SQL Injection 原理： 攻击者通过在输入中注入恶意 SQL 语句，来篡改原有的 SQL 查询逻辑，从而绕过验证、获取或修改数据库中的数据。
//举例：假设查询语句为：SELECT * FROM users WHERE username = '$username' AND password = '$password';

//4. 文件上传漏洞原理： 攻击者上传恶意脚本文件（如 PHP、JSP 等），服务器若未进行严格验证，就可能执行该恶意脚本，导致服务器被控制。
//举例：攻击者上传一个伪装成图片的 PHP 文件 shell.php.jpg，服务器只判断扩展名但并未检查内容或 MIME 类型，结果该文件被执行。


// 还需要大家去了解一下什么是 cURL 请求
//cURL 是一个用来发送网络请求的命令行工具，它可以让你通过命令行或代码向服务器发起各种类型的请求，比如 GET、POST、PUT 等。它特别常用于调试接口、测试服务器响应、自动化脚本中调用 API 等场景。
// ⚠️cURL 既有命令行版本，也有库版本，比如在 PHP 中使用 curl_init()。
// ⚠️支持各种协议：HTTP、HTTPS、FTP、SFTP、SMTP 等。

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echoHr();
    echoWithBr('只有 POST 请求才会输出以下内容:');
    // 处理表单提交
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? '';

    printRWithBr($_POST);

    // 这里可以添加更多的表单处理逻辑，比如验证和存储数据
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Age: $age<br>";
}
