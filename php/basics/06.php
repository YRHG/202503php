<?php


// 变量的作用域
// 局部作用域: 在函数内部定义的变量, 只能在函数内部访问
// 全局作用域: 在函数外部定义的变量, 可以在函数内部访问, 但需要使用 global 关键字
$userAge = 25; // 全局变量
function getUserinfo($userAge): void
{
    // echo $userAge; // 报错: Undefined variable: userAge
    // global $userAge; // 声明 $userAge 为全局变量, 可以这么做但是不推荐, 如果你想要访问全局变量, 你可以直接传递参数
    // echo $GLOBALS['userAge']; // 访问全局变量, $GLOBALS 是一个包含所有全局变量的数组, 这个同样也是不推荐使用的, 因为它会影响代码的可读性, 破坏函数的封装性
    echo $userAge . '<br>'; // 输出: 25
    $username = 'lustormstout'; // 局部变量
}

// var_dump($username); // 报错: Undefined variable: username
getUserinfo($userAge); // 调用函数

// 静态变量
function staticVariableExample(): void
{
    static $count = 0; // 静态变量, 在函数调用之间保持其值
    // $count = 0; // 局部变量, 每次调用函数都会重新初始化
    $count++;
    echo "函数被调用了 $count 次<br>";
}

staticVariableExample(); // 输出: 函数被调用了 1 次
staticVariableExample(); // 输出: 函数被调用了 2 次
staticVariableExample(); // 输出: 函数被调用了 3 次
// 这里的静态变量是不会被销毁的, 直到脚本执行完毕. 在编程语言中我们一般将越贴近于人类语言的变成语言称为高级语言,
// 贴近于计算机语言的编程语言称为低级语言. 这里的静态变量是一个高级语言的概念, 但是在底层实现上是通过低级语言来实现的.
//垃圾回收是指运行时系统自动识别“不可达”对象并回收其内存的过程，开发者无需手动释放内存即可降低内存管理错误的风险。

// 可变函数
function helloWorld(): void
{
    echo "Hello, World!<br>";
}

$helloWorld = 'helloWorld'; // 函数名
$helloWorld(); // 调用函数, 输出: Hello, World!

// 匿名函数
$greet = function ($name) {
    echo "你好, " . $name . "！<br>";
};
$greet('小明'); // 调用匿名函数, 输出: 你好, 小明！

// 使用 use 捕获外部变量
$messagePrefix = "重要消息: ";
$sendMessage = function ($text) use ($messagePrefix) { // 按值捕获 $messagePrefix
    echo $messagePrefix . $text . "<br>";
    // $messagePrefix = "改不了"; // 错误，因为是按值捕获的副本
};
// echo $messagePrefix . "<br>"; // 输出: 重要消息:
$sendMessage("会议推迟了"); // 输出: 重要消息: 会议推迟了

$count = 0;
$increment = function () use (&$count) { // 按引用捕获 $count
    $count++;
};
$increment();
$increment();
echo "Count is now: " . $count . '<br>'; // 输出: Count is now: 2

// 作为回调函数传递给 array_map
$numbers = [1, 2, 3, 4];
$squares = array_map(function ($iem) {
    return $iem * $iem;
}, $numbers);
print_r($squares); // 输出: Array ( [0] => 1 [1] => 4 [2] => 9 [3] => 16 )
echo "<br>";

// 箭头函数
$numbers = [1, 2, 3, 4];
$factor = 3; // 父作用域变量

// 箭头函数自动捕获 $factor
$multiplied = array_map(fn($item) => $item * $factor, $numbers);

print_r($multiplied); // 输出: Array ( [0] => 3 [1] => 6 [2] => 9 [3] => 12 )
echo "<br>";