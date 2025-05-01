<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers_2.php';

//为解决 HTTP 无状态的问题，主要使用两种技术来** 保持状态 (State Management) **
//Cookie 和 Session

//setcookie(
//    string $name,                // Cookie 的名称
//string $value = "",          // Cookie 的值 (会被自动 URL 编码)
//int $expires_or_options = 0, // 过期时间 (Unix 时间戳) 或 选项数组 (PHP 7.3+)
//string $path = "",           // 有效路径 (默认当前目录, '/' 表示整个域名)
//string $domain = "",         // 有效域名 (默认当前域名, '.example.com' 可用于子域名)
//bool $secure = false,         // true 表示仅通过 HTTPS 发送
//bool $httponly = false        // true 表示禁止 JavaScript 访问 (提高安全性)
//): bool

//设置cookie
//$secure: 如果设为 true，该 Cookie 只会在通过安全的 HTTPS 连接发送时才会被传输。强烈推荐对包含敏感信息的 Cookie 设置为 true。
//$httponly: 如果设为 true，该 Cookie 将不能通过客户端脚本（如 JavaScript 的 document.cookie）访问。这有助于防范 XSS 攻击窃取 Cookie。强烈推荐设置为 true。
$cookie_name = "albert";
$cookie_value = "dark";
$expiry_time = time() + (86400 * 30); // 86400 秒 = 1 天

// 调用 setcookie()，在所有 HTML 输出之前
// 路径设为'/', 开启 secure 和 httponly
////HttpOnly：表示这个 cookie 只能被服务器访问，JavaScript 无法读取，防止 XSS 攻击 ✅
setcookie($cookie_name, $cookie_value, $expiry_time, "/", "", true, true);

// PHP 7.3+ 的选项数组方式:
/*
setcookie($cookie_name, $cookie_value, [
'expires' => $expiry_time,
'path' => '/',
'domain' => '', // 默认当前域名
'secure' => true,
'httponly' => true,
'samesite' => 'Lax' // Lax 或 Strict 通常比 None 更安全
]);
*/

//开启回话
session_start();

setcookie($cookie_name, $cookie_value, $expiry_time, "/", "", true, true);

varDumpWithBr($_COOKIE['albert']);

// ❓同源策略
// ❓跨域请求
// ❓HTTP头字段 https://zh.wikipedia.org/wiki/HTTP%E5%A4%B4%E5%AD%97%E6%AE%B5

// --- 存储数据 ---
// 假设用户登录成功

$_SESSION['user_id'] = 123;
$_SESSION['username'] = 'Albert';
$_SESSION['login_time'] = time();
$_SESSION['preferences'] = ['albert' => 'dark', 'lang' => 'zh'];
echo "Session 数据已设置。<br>";

// --- 读取数据 ---
if (isset($_SESSION['username'])) {
    echo "欢迎回来, " . htmlspecialchars($_SESSION['username']) . "!<br>";
} else {
    echo "用户未登录。<br>";
}

//读取数据
if (isset($_SESSION['username'])) {
    echo "welcome back" . htmlspecialchars($_SESSION['username']) . "!<br>";

}
     else{
         echo "用户未登录。<br>";
     }
//使用 ?? 提供默认值
//不是lang就默认en英文
$lang = $_SESSION['preferences']['lang'] ?? 'en';
 echo "用户语言设置: " . htmlspecialchars($lang) . "<br>";

// 修改数据
//修改语言设置为en英文
//可保存在session文件中
$_SESSION['preferences']['lang'] = 'en_US';

// 删除单个 session 变量
//删除login_time变量
//unset删除
unset($_SESSION['login_time']);

//启动session
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $suername = $_POST['suername'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ;

    if ($username === 'albert' && $password === '1***4') {
        $_SESSION['username'] = $username;

        // 用户勾选了记住我，就设置 cookie，保存用户名
        if ($remember) {
            setcookie('remember_user', $username, time() + (86400 * 30), "/", "", false, true); // 保存30天
        }

        // 登录后跳转
        //响应头header location到welcome.php
        header("Location: welcome.php");
        //跳转后停止
        exit;
    }
    //输出错误信息
    else {
        $error = "用户名或密码错误";
    }
}

// 如果浏览器里有 remember_user 的 cookie，自动填入用户名
$savedUsername = $_COOKIE['remember_user'] ?? '';
