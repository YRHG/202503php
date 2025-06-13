<?php

require_once '../helpers.php';

// is_numeric() 检查变量是数字或数字字符串
// true or false 返回

echoWithBr(is_numeric("123"));    // true

echoWithBr(is_numeric(3.14));       // true，浮点数
echoWithBr(is_numeric("123"));      // true，字符串形式的数字
echoWithBr(is_numeric("3.14"));     // true，字符串形式的浮点数
echoWithBr(is_numeric("0123"));     // true，八进制数字字符串

echoWithBr(is_numeric("123abc"));   // false，不纯粹是数字
echoWithBr(is_numeric("abc"));      // false
echoWithBr(is_numeric(""));         // false，空字符串
echoWithBr(is_numeric(null));       // false

echo"<br>";

echoHr();
$date = 100;
$typeString = gettype($date);
echoWithBr($typeString);
echoWithBr("变量 $date 的类型是：{$typeString}\n"); //输出：变量$date的类型是integer

switch($typeString) {
    case "integer":
        echo"这是一个整数。\n";
        break;
        case "string":
            echo"这是一个字符串.\n";
            break;
        default:
            echo"这是其他类型。\n";

}

if ($typeString == 'integer') {
    echoWithBr("这是一个整数。\n");
} elseif ($typeString == 'string') {
    echo "这是一个字符串。\n";
} else {
    echoWithBr("这是一个其他类型。\n");
}

$value = "123.45"; // 初始是字符串
echoWithBr("初始类型: " . gettype($value) . ", 值: ");
varDumpWithBr($value); // string(6) "123.45"
echoWithBr("<br>");

//转化为整数
settype($value, "integer");  //$var 要噶遍类型的变量 “引用传递”，原变量本身会被修改
echoWithBr("转换为 int 后: " . gettype($value) . ", 值: "); //“integer”&“int” 转化为整数
varDumpWithBr($value); // integer, int(123) (小数部分截断)
echoWithBr("<br>");

echoHr();
$value = "123.45"; // 初始是字符串
varDumpWithBr(intval($value)); // 转换为整数
varDumpWithBr((int)$value); // 转换为整数
varDumpWithBr((float)$value); // 转换为浮点数

echoHr();
varDumpWithBr(empty($student));

echoHr();
varDumpWithBr(empty($student));
//if (!empty($student)) {
//    # to do do something
//}
$classes = [
    'class1' => ['student1', 'student2'],
    'class2' => ['student3', 'student4'],
];
unset($classes['class1']); // 删除 class1
varDumpWithBr($classes); // class2 => student3, student4

echoHr();
$pi = 3.1415926;
echoWithBr(round($pi, 2)); // 四舍五入保留两位小数, 输出: 3.14
echoWithBr(round($pi, 3)); // 四舍五入保留三位小数, 输出: 3.142

echoWithBr(mt_rand(1, 100)); // 输出: 随机数, 1 到 100 之间

try {
    $password = random_int(100000, 999999) . bin2hex(random_bytes(10));
} catch (\Random\RandomException $e) {
    echo "生成随机密码失败: " . $e->getMessage();
    exit;
}
echoWithBr($password); // 输出: 随机密码, 10 位随机字符串

echoHr();
echoWithBr(time()); // 输出: 当前时间戳
echoWithBr(microtime(true)); // 输出: 当前时间戳, 包含微秒
echoWithBr("请求开始时间 (秒): " . ($_SERVER['REQUEST_TIME'] ?? 'N/A') . "\n");
echoWithBr("请求开始时间 (带微秒): " . ($_SERVER['REQUEST_TIME_FLOAT'] ?? 'N/A') . "\n");
//echoWithBr(date('Y-m-d', strtotime('-1 year')));
echoWithBr(date("L", strtotime(date('Y-m-d', strtotime('-1 year')))));

