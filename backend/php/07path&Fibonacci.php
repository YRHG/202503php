<?php

//递归函数例子
//阶乘定义：n! = n * (n-1) * (n-2) * ... * 1。
//递归定义：n! = n * (n-1)!，基本情况：0! = 1。
function factorial($n) {
    // 基本情况: 0! 或 1! 都等于 1
    if ($n <= 1) {
        return 1;
    } else {
        // 递归步骤: n! = n * (n-1)!
        return $n * factorial($n - 1); // 调用自身，但问题规模减小 (n-1)
    }
}

echo "5! = " . factorial(5); // 输出: 5! = 120
echo "<br>";


//递归函数计算目录深度
//定义函数getDirDepth
//参数$path类型为string 路径为串

function getDirDepth(string $path): int{
//移除字符串右侧的空白或指定字符，剔除末尾可能多余的目录分隔符。
 $path = rtrim($path, DIRECTORY_SEPARATOR);
//读取目录
 $items = @scandir($path);//返回指定目录下的所有文件和子目录名数组// @ 抑制警告//scandir — 列出指定路径中的文件和目录

    if ($items === false) {
     return 0;
 }
//初始化最大深度变量为0
 $maxDepth = 0;
 //开始遍历所有目录
 //foreach = for each 每一个都来一次

 foreach ($items as $item) {
     if ($item === '.' || $item === '..') {
         continue;
     }
     $subPath = $path . DIRECTORY_SEPARATOR . $item;
     if (is_dir($subPath)) {
         $depth = getDirDepth($subPath);
         if ($depth > $maxDepth) {
             $maxDepth = $depth;
         }
     }
 }
 return $maxDepth;
}
$root = '/Library/WebServer/Documents';
echo '目录层级深度为：' . getDirDepth($root);
echo "<br>";

//斐波那契数列计算
//还得查一下啥是斐波那契数列
function fibonacciRecursive($n) {
    if ($n <= 0) return 0;
    if ($n == 1) return 1;
    return fibonacciRecursive($n - 1) + fibonacciRecursive($n - 2);
}

// 计算第100项（索引从0开始）
echo fibonacciRecursive(100); // 输出: 算不出来