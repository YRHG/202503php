<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers.php';

//  正则表达式
//  {{：匹配文字 {{，用来标记模板的开始。
//   }}：匹配文字 }}，用来标记模板的结束。
//   \s：匹配任何空白字符（空格、制表符、换行符等）。
//   *：表示“零个或多个”，意思是占位符的两边可以有空格，但不要求必须有空格。
//   \w：匹配字母、数字、下划线（a-z、A-Z、0-9、_）。
//   +：表示“一个或多个”，意思是占位符内的内容可以是由一个或多个字母数字下划线组成的 key。

echoHr();
$string = "aslkdjfaowjlaslj1230";
$preg = '/^[a-zA-Z0-9]+$/';
$preg = '/\w{8}/';

$html = "<b> body text </b> & <i>italic text </i>";
$html = preg_replace($preg, $string, $html);

//  贪婪模式
//  (.* 匹配尽可能多的字符)

preg_match('/<b>(.*)<\/b>/', $html, $matches_greedy);

// 输出: [0 => 'bold text and italic text', 1 => 'bold text and italic text']
printRWithBr($matches_greedy);

echoHr();

// 懒惰模式
// (.? 匹配尽可能少的字符，直到遇到第一个 )
preg_match('/<b>(.?)<\/b>/', $html, $matches_lazy);

// 输出: [0 => 'bold text', 1 => 'bold text']
printRWithBr($matches_lazy);

//分组与捕获
//使用圆括号 () 可以：将模式的一部分组合在一起，以便对其应用量词或进行其他操作。
// /(abc)+/ 匹配一个或多个 "abc"。

//锚点定位匹配
//  ^ : 匹配**字符串的开头**（或者行的开头，如果使用 m 修正符）。
//  $ : 匹配**字符串的结尾**（或者行的结尾，如果使用 m 修正符）。
//  \b: 匹配**单词边界**（单词字符 \w 和非单词字符 \W 之间的位置，或字符串的开头/结尾）。用于确保匹配的是整个单词，而不是单词的一部分。
//  \B: 匹配**非单词边界**。

echoHr();
$string = "start_alskdjfiwalwiafj_123_end";
$preg = '/^Start/';
$preg = '/end$/';
$preg = '/^\d+$/';

// 模式修正符
// 小u 中文 大U 非贪婪模式
// i 不区分大小写

$email = "albert975816342@icloud.com";
//  一个相对简单的 Email 验证模式 (注意：完美的 Email 正则非常复杂)
//  解释:
//  ^                  - 字符串开头
//  [a-zA-Z0-9.*%+-]+  - 用户名部分：一个或多个字母、数字、点、下划线、百分号、加号、减号
//  @                  - 字面的 "@" 符号
//  [a-zA-Z0-9.-]+     - 域名部分：一个或多个字母、数字、点、减号
//  .                 - 字面的 "." 符号 (需要转义)
//  [a-zA-Z]{2,}       - 顶级域名：至少两个字母
//  $                  - 字符串结尾
//  i                  - 不区分大小写修正符
//  小括号 (...) 创建了捕获组
$pattern = '/^\d+$/';

// 使用 preg_match 进行验证和捕获
if (preg_match($pattern, $email, $matches)) {
//  如果 preg_match 返回 1，表示匹配成功

    echo "有效的 Email 地址。\n";
    echo "完整匹配: " . htmlspecialchars($matches[0]) . "\n";
    echo "用户名部分 (捕获组 1): " . htmlspecialchars($matches[1]) . "\n";
    echo "域名部分 (捕获组 2): " . htmlspecialchars($matches[2]) . "\n";
} else {
// 如果 preg_match 返回 0 或 false
    echo "无效的 Email 地址格式。\n";
}

/*
 * 输出：
 * 有效的 email 地址。
 * 完整匹配： albert975816342@icloud.com
 * 用户名部分 （捕获组 1）：
 * 域名部分 （捕获组 2）：
 */

echoHr();
$text = "访问我们的网站 https://www.example.com 或查看 ftp://files.example.org/data.zip";

// 一个简化的 https://www.google.com/search?q=URL 匹配模式
// (实际 https://www.google.com/search?q=URL 匹配可能更复杂)
// 匹配 http, https, ftp, ftps 协议

$pattern = '^\b(https?|ftps?)://[-A-Z0-9+&@#/%?=~|!:,.;]*[-A-Z0-9+&@#/%=~|]^i';

// 使用 preg_match_all 查找所有匹配项
// 使用 PREG_SET_ORDER
$match_count = preg_match_all($pattern, $text, $all_matches, PREG_SET_ORDER);

if ($match_count > 0) {
    echo "找到了 " . $match_count . " 个 https://www.google.com/search?q=URL:\n";
    echo "<ul>";
    foreach ($all_matches as $match) {
        // $match[0] 是完整的 https://www.google.com/search?q=URL 匹配
        // $match[1] 是第一个捕获组 (协议部分)
        $url = htmlspecialchars($match[0]);
        $protocol = htmlspecialchars($match[1]);
        echo "<li>协议: {$protocol}, https://www.google.com/search?q=URL: {$url}</li>";
    }
    echo "</ul>";
// echo "<pre>Matches array:\n"; print_r($all_matches); echo "</pre>";
} else {
    echo "没有找到 https://www.google.com/search?q=URL。\n";
}

echoHr();
// 3. 隐藏手机中间号
$phone = "用户手机号： 07014252333";
// 捕获前三位和后四位
$pattern3 = '/(\d{3})\d{4}(\d{4})/';
// 替换中间号****
$replacement3 = '$1****$2';
$masked_phone = preg_replace($pattern3, $replacement3, $phone);
echo "原始: {$phone}\n";
// 输出: 隐藏后: 用户手机号: 138****5678
echo "隐藏后: {$masked_phone}\n";

echoHr();

$markdown = "这是一个链接 [PHP官网](https://www.php.net) 和另一个 [搜索](https://www.google.com/search?q=URL)。";

// 模式：匹配 文字
// [(.?)] : 捕获链接文字 (非贪婪)
// (     : 匹配左括号
// (.?)  : 捕获 https://www.google.com/search?q=URL (非贪婪)
// )     : 匹配右括号
$pattern = '/\[(.*?)]\((.*?)\)/';

// 定义回调函数
$callback = function($matches) {
    // $matches[0] 是整个匹配 "文字"
    // $matches[1] 是第一个捕获组 (文字)
    // $matches[2] 是第二个捕获组 (https://www.google.com/search?q=URL)
    $text = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8'); // 对文字进行 HTML 转义
    $url = htmlspecialchars($matches[2], ENT_QUOTES, 'UTF-8');  // 对 https://www.google.com/search?q=URL 也进行转义 (防止属性注入)

    // 返回 HTML 链接标签
    return '<a href="' . $url . '" target="_blank">' . $text . '</a>';
};

// 执行替换
$html = preg_replace_callback($pattern, $callback, $markdown);

echo "Markdown: " . htmlspecialchars($markdown) . "\n<br>";
echo "HTML: " . htmlspecialchars($html) . "\n<br>"; // 查看源码
echo "渲染效果: " . $html . "\n"; // 在浏览器查看效果

//preg_quote() 转译正则表达式特殊符号字符
//preg_quote(string $str, ?string $delimiter = null): string
//在字符串 $str 中所有正则表达式的特殊字符（如 . \ + * ? [ ^ ] $ ( ) { } = ! < > | : - #）前面加上一个反斜杠 \ 进行转义。

echoHr();

// 假设 $userInput 是用户输入，可能包含特殊字符
$userInput = "Search for price $10.00?";

// 我们想在文本中精确匹配这个用户输入字符串
// 直接用 $userInput 作为模式是危险的，因为 $ ? . 等是元字符
// $pattern = "/{$userInput}/"; // 错误！

// 先使用 preg_quote 进行转义
$quotedInput = preg_quote($userInput, '/'); // 转义 $userInput，并额外转义可能作为定界符的 /

// 构建安全的正则表达式模式
$pattern = "/" . $quotedInput . "/";
echo "安全模式: " . htmlspecialchars($pattern) . "\n";
// 输出类似: 安全模式: /Search\ for\ price\ $10.00?/

$text = "Did you Search for price $10.00? Yes!";
if (preg_match($pattern, $text)) {
    echo "找到了精确匹配！";
} else {
    echo "未找到匹配。";
}
