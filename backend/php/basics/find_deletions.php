<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers.php';

$testData = [
    [
        'string' => '已经是string字符串了，那我随便写点啥汉子吧，我是albert今年50岁出生在山西。',
        'values' => ['汉子' => 'string'],
        'message' => '1、字符串中没有标签需要替换，直接输出结果。 ✅'
    ],
    [
        'string' => '讲中文 {{ 汉子 }}. 汉子是 {{ 子 }}.',
        'values' => ['汉子' => 'string', '年龄' => 50],
        'message' => '2、字符串中有标签需要替换，返回替换之后的字符串。 ✅'
    ],
    [
        'string' => 'Say hello to {{ name }}. He is {{ age }}.',
        'values' => ['汉子' => 'string', '年龄' => 50, 'male' => true],
        'message' => '3、字符串中有标签需要替换，values 中多余给出来的值不做任何处理。 ✅'
    ],
    [
        'string' => 'The next F1 race will be in {{ city }} on {{ date }}.',
        'values' => ['city' => 'Melbourne', 'date' => '2022-08-25'],
        'message' => '4、给定不一样的变量名也同样兼容。 ✅'
    ],
    [
        'string' => 'The opening five weekends of the season have been challenging for Hamilton after his switch to {{ toTeam }} from {{ fromTeam }} in the off-season, which has so far yielded a best Grand Prix result of {{ bestResult }} in {{ city }}.',
        'values' => ['toTeam' => 'Ferrari', 'fromTeam' => 'Mercedes', 'bestResult' => 'fifth', 'city' => 'Bahrain', 'date' => '2022-08-25'],
        'message' => '4、给定不一样的变量名也同样兼容。 ✅'
    ],
//    [
//        'string' => 'The next F1 race will be in {{ city }} on {{ date }}.',
//        'values' => ['city' => 'Spa'],
//        'message' => '5、字符串中有标签需要替换，但是给定的 values 值中缺少对应的参数，会抛出异常。 ❌'
//    ]
];

//我自己试试
// The Porsche 911 model series (pronounced Nine Eleven or in German: Neunelf) is a family of german two-door,
// high performance rear-engine sports cars, introduced in September 1964 by Porsche AG of Stuttgart, Germany.
// Now in its eighth generation, all 911s have a rear-mounted flat-six engine, and usually 2+2 seating, except for special 2-seater variants.

$testData2 = [
    'string' => 'The {{model}} model series (pronounced Nine Eleven or in {{country}}: Neunelf) is a family of german two-door, 
    high performance rear-engine sports cars, introduced in September {{years}} by Porsche AG of Stuttgart, {{country}}.
    Now in its eighth generation, all {{model}} have a rear-mounted flat-six engine, and usually 2+2 seating, except for special 2-seater variants.',

     'values' => [
    'model' => 'Porsche 911',
    'years' => '1964',
    'country' => 'Germany'
],
     'message' => '这是一个包含多个相同变量标签的模板字符串测试 ✅'
];

//正则表达式
//{{：匹配文字 {{，用来标记模板的开始。
//}}：匹配文字 }}，用来标记模板的结束。
//\s：匹配任何空白字符（空格、制表符、换行符等）。
//*：表示“零个或多个”，意思是占位符的两边可以有空格，但不要求必须有空格。
//\w：匹配字母、数字、下划线（a-z、A-Z、0-9、_）。
//+：表示“一个或多个”，意思是占位符内的内容可以是由一个或多个字母数字下划线组成的 key。
//()：括号表示一个“捕获组”，这个捕获组会提取 {{ key }} 中的 key 部分，在回调函数里 $matches[1] 就是这个 key。

//preg_replace_callback('/{{\s*(\w+)\s*}}/', function ($matches) use ($values) {
//    ...
//}, $template);//preg_replace_callback() 会把找到的所有匹配项通过回调函数来处理。在回调函数中取出 key，然后用 values 中的对应值替换。

//利用正则表达式来查找替换数组
//preg_replace_callback()可以 用正则找出所有 {{ key }}，逐个替换；
$template = ['The {{model}} model series (pronounced Nine Eleven or in {{country}}: Neunelf) is a family of german two-door, 
    high performance rear-engine sports cars, introduced in September {{years}} by Porsche AG of Stuttgart, {{country}}.
    Now in its eighth generation, all {{model}} have a rear-mounted flat-six engine, and usually 2+2 seating, except for special 2-seater variants.'];

    $values = [
        'model' => 'Porsche 911',
        'years' => '1964',
        'country' => 'Germany'
    ];
//preg_replace_callback()：用正则找出所有 {{ key }}，逐个替换；
//(\w+)：表示提取里面的 key（字母数字下划线）；
//array_key_exists()：检查 $values 中有没有这个 key；
//如果没找到，就抛出异常missing
function renderTemplate(string $template, array $values): string {
    return preg_replace_callback('/{{\s*(\w+)\s*}}/', function ($matches) use ($values) {
        $key = $matches[1];
        if (array_key_exists($key, $values)) {
            return $values[$key];
        } else {
            throw new Exception("Missing value for key: {$key}"); // 抛出异常 丢失key $key
        }
    }, $template);
}
// 因为$template 是数组 数组需要foreach
//防止前端问题
//foreach遍历数组
foreach ($template as $temp) {
    try {
        echo renderTemplate($temp, $values);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

