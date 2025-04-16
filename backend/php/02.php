<?php

$message = "学习 PHP"; //复制字符串
$userCount = 105; //
$pricePerItem = 19.99; // 赋值浮点数
$isActive = true;   // 赋值布尔值
// 可以将一个变量的值赋给另一个变量
$totalPrice = $userCount * $pricePerItem;
$statusMessage = $message;
echo $statusMessage; // 输出: 学习 PHP
echo $totalPrice;   // 输出: 2098.95

echo "<br>";

$numberString = "5"; //字符串
$number = 10; //这是整数
$numberInt = 0;
$sum = $numberString + $numberInt; //// PHP 会将 $numberString 转为整数 5
echo $sum; // 输出: int(15)
var_dump($sum);
$result = $numberString == 5; // 使用 '==' 比较时，字符串 "5" 被转为整数 5
var_dump($result); // 输出: bool(true)

$resultStrict = $numberString === 5; // 使用 '===' 严格比较时，类型不同，不转换
var_dump($resultStrict); // 输出: bool(false)

echo "<br>";

//优先级
$result = 2 + 3 * 4; // 乘法优先
$result_grouped = (2 + 3) * 4; //括号优先
$a = 5; $b = 10; $c = 15;// $check = $a < $b && $b < $c; // true (逻辑运算符优先级低于比较运算符)大小比加减乘除优先
$check = ($a < $b) && ($b < $c); // 加括号更清晰 &&是逻辑与（AND）运算符，用于判断两个表达式是否都为真
$x = $y = $z = 10; // 赋值运算符是右结合，等同于 $x = ($y = ($z = 10));

echo"<br>";

//执行运算符
//别瞎玩
// 假设在 Linux/macOS 系统
// $output = `ls -la`; // 执行 ls -la 命令
// echo "<pre>$output</pre>"; // 输出命令结果

// $who = `whoami`; // 获取当前用户名

echo"<br>";


// 合并赋值运算符
//这是 Null 合并运算符的赋值版本
if(!isset($variable) || is_null($variable)){
    $variable = $default_value;
}
// 可以理解为
$variable = $variable ?? $default_value;

//如果 $variable 不存在或为 null，则将 $default_value 赋给它。

$config['timeout'] = null;
$config['timeout'] ?? = 30 //因为 $config['timeout'] 是 null，所以赋值为 30
var_dump($config['timeout']); // 输出: int(30)
$config['retry'] = 5;
$config['retry'] ??= 3;   // 因为 $config['retry'] 不是 null，所以不赋值
var_dump($config['retry']); // 输出: int(5)

// $config['new_option'] ??= 'default'; // 如果 $config['new_option'] 未设置，则赋值为 'default'


echo"<br>";


// 数据运算符
$arr1 = ['a' => 1, 'b' => 2];
$arr2 = ['b' => 3, 'c' => 4];
$union = $arr1 + $arr2; // 数组合并
var_dump($union); // 输出: array(3) { ["a"]=> int(1) ["b"]=> int(2) ["c"]=> int(4) }

$arr3 = ['a' => 1, 'b' => '2']; // 注意 '2' 是字符串
$arr4 = ['b' => 2, 'a' => 1]; // 顺序不同，'b' 的值是整数
var_dump($arr1 == $arr3); // 输出: bool(true), == 的时候值的类型无关, 只判断值本身, PHP 会自动转换类型在比较的时候
var_dump($arr1 === $arr3); // 输出: bool(false), 顺序相同, 值的类型不同
var_dump($arr1 == $arr4); // 输出: bool(true), == 的时候顺序无关
var_dump($arr1 === $arr4); // 输出: bool(false), 顺序不同

echo "<br>";
var_dump(array_merge($arr1, $arr2)); // 输出: array(3) { ["a"]=> int(1) ["b"]=> int(3) ["c"]=> int(4) }, array_merge() 会覆盖相同的键

// 条件赋值运算符
$age = 20;
$status = ($age >= 18) ? '成年' : '未成年'; // 三元运算符
echo "<br>";
echo $status; // 输出: 成年

$username = $_GET['user'] ?: 'guest'; // 如果 $_GET['user'] 不存在会产生一个 Warning
echo "<br>";
echo $username; // 如果 $_GET['user'] 存在且不为空，则输出 $_GET['user'] 的值，否则输出 'guest'
$name = $_GET['username'] ?? '默认用户'; // null 合并运算符
echo "<br>";
echo $name; // 如果 $_GET['username'] 存在且不为 null，则输出 $_GET['username'] 的值，否则输出 '默认用户'

$nickname = $userNickname ?? $userPhone ?? $userEmail ?? '匿名用户'; // 如果 $userNickname, $userPhone, $userEmail 都不存在，则输出 '匿名用户'
echo "<br>";
echo $nickname;

$userAvatar ??= 'default.png'; // 如果 $userAvatar 不存在 || 为 null，则赋值为 'default.png'
echo "<br>";
echo $userAvatar;

// 条件语句
$userAge = 20;
echo "<br>";
if ($userAge >= 18) {
    echo "成年";
}
echo "<br>";
// if ($userAge >= 18) echo "成年"; // 单行 if 语句, 不推荐不要这么写

$score = 55;
if ($score >= 60) {
    echo "成绩及格！";
} else {
    echo "成绩不及格。";
}
echo "<br>";

$score = 85;
if ($score >= 90) {
    echo "优秀 (A)";
} elseif ($score >= 80) { // 到这里时，$score >= 90 肯定是 false 了
    echo "良好 (B)"; // 因为 85 >= 80，执行这句，然后跳出整个结构
} elseif ($score >= 70) {
    echo "中等 (C)";
} elseif ($score >= 60) {
    echo "及格 (D)";
} else {
    echo "不及格 (F)";
}
echo "<br>";

$a = 10;
$b = '10';
if ($a === $b) { // 这里是比较值
    echo "相等"; // 这里是比较类型
}
echo "<br>";

// switch 语句
$role = 'editor'; // 假设用户角色是编辑

switch ($role) {
    case 'admin':
        echo "显示：用户管理、文章管理、系统设置\n";
        break; // 执行完 admin 的就跳出

    case 'editor':
        echo "显示：文章管理\n";
    // 注意这里故意没有 break! 会继续执行下面的 case

    case 'author':
        echo "显示：写新文章\n";
        break; // 执行完 author 的就跳出 (editor 角色也会执行到这里)

    case 'subscriber':
        echo "显示：查看文章\n";
        break;

    default:
        echo "无效的角色或未登录用户。\n";
}

// for 循环
for ($i = 0; $i < 5; $i++) {
    echo "第 $i 次循环\n";
}
echo "<br>";

// while 循环
$i = 0; // 初始化在循环外
while ($i < 5) { // 条件判断在循环开始前
    echo "当前数字是: " . $i . "\n";
    echo "<br>";
    $i++; // 更新计数器在循环体内
}

//while (true) { // 无限循环
//    echo "无限循环\n";
//    break; // 这里是为了演示，实际中要小心使用
//}

// foreach 循环
$fruits = ['apple', 'banana', 'orange'];
foreach ($fruits as $fruit) {
    echo "水果: " . $fruit . "\n";
    echo "<br>";
}

foreach ($fruits as $index => $fruit) {
    echo "索引: " . $index . ", 水果: " . $fruit . "\n";
    echo "<br>";
}

// foreach 循环遍历关联数组
$person = [
    "name" => "小明",
    "age" => 18,
    "city" => "东京"
];
foreach ($person as $key => $value) {
    echo "键: " . $key . ", 值: " . $value . "\n";
    echo "<br>";
}

// 通过引用修改数组元素
$fruits = ['apple' => 100, 'banana' => 80, 'orange' => 60];
foreach ($fruits as $key => &$price) { // 注意这里的 & 符号
    if ($key === 'apple') {
        $price *= 0.9; // 打九折
    }
}
unset($price); // 解除引用，防止后续代码影响
var_dump($fruits);
echo "<br>";

$orders = [
    ['productName' => 'apple', 'price' => 20, 'userId' => 1],
    ['productName' => 'banana', 'price' => 30, 'userId' => 10],
    ['productName' => 'orange', 'price' => 18, 'userId' => 13]
];
foreach ($orders as $order) {
    echo "商品名称: " . $order['productName'] . "\n";
    echo "<br>";
    echo "价格: " . $order['price'] . "\n";
    echo "<br>";
    echo "用户ID: " . $order['userId'] . "\n";
    echo "<br>";
}

$users = [
    ['name' => '小明', 'age' => 18, 'isAdmin' => 0],
    ['name' => '小红', 'age' => 20, 'isAdmin' => 0],
    ['name' => '小刚', 'age' => 22, 'isAdmin' => 1]
];
foreach ($users as $user) {
    if (!$user['isAdmin']) {
        continue; // 跳过非管理员用户
    }
    echo "这里执行的是显示进入管理后台的链接\n";
}

$message = "学习 PHP"; //复制字符串
$userCount = 105; //
$pricePerItem = 19.99; // 赋值浮点数
$isActive = true;   // 赋值布尔值
// 可以将一个变量的值赋给另一个变量
$totalPrice = $userCount * $pricePerItem;
$statusMessage = $message;
echo $statusMessage; // 输出: 学习 PHP
echo $totalPrice;   // 输出: 2098.95
