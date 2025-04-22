<?php

require_once '../helpers.php';

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
    Now in its eighth generation, all {{model}} have a rear-mounted flat-six engine, and usually 2+2 seating, except for special 2-seater variants.'

     'values' => [
    'model' => 'Porsche 911',
    'years' => '1964',
    'country' => 'Germany'
],
     'message' => '这是一个包含多个相同变量标签的模板字符串测试 ✅'
];
