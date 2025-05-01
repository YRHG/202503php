<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers.php';

//php与文档交互
//文件系统函数
echoHr();
$path1 = "/var/www/html/images/logo.png";//网络
$path2 = "C:\\Users\\John\\Documents\\report.pdf";// win系统转译斜杠
$path3 = "my_file.txt"; // 只有文件名
$path4 = "/etc/php/";    // 目录

//无法检查文件是否存在

echo basename($path1); //输出logo.png
echo "<br>";
echo basename($path1, ".png"); // 输出: logo 移除后缀名
echo "<br>";
echo basename($path2); // 输出: report.pdf (能处理 Windows 路径)
echo "<br>";
echo basename($path3); // 输出: myf_ile.txt
echo "<br>";
echo basename($path4); // 输出: php (返回最后的组件)

echoHr();
$path = "/var/www/html/images/logo.png";
echo dirname($path);      // 输出: /var/www/html/images
echo "<br>";
echo dirname($path, 2); // 输出: /var/www/html (向上两级)
echo "<br>";
echo dirname("/var/www/html"); // 输出: /var/www
echo "<br>";
echo dirname("myfile.txt"); // 输出: . (当前目录)

echoHr();
$path = "/var/www/html/images/logo.PNG";
// 获取所有信息
$infoAll = pathinfo($path);
echo "<pre>All info: ";//<pre>原样显示 可以用插件
print_r($infoAll);
echo "</pre>";

echoWithBr(DIRECTORY_SEPARATOR); // 输出: /
echoHr();
$file = './10.php';
$dir = '/Library/WebServer/Documents/202503php/php/basics/';
if (file_exists($file)) {
    echoWithBr("文件 $file 存在。");
} else {
    echoWithBr("文件 $file 不存在。");
}

if (is_dir($dir)) {
    echoWithBr("目录 $dir 存在。");
} else {
    echoWithBr("目录 $dir 不存在。");
}

if (is_file($file)) {
    echoWithBr("文件 $file 是一个文件。");
} else {
    echoWithBr("文件 $file 不是一个文件。");
}

echoWithBr(filetype($file)); // 输出: file

echoWithBr(disk_free_space($dir)); // 返回当前磁盘上可用的空间
echoWithBr(disk_total_space($dir)); // 返回当前磁盘的总空间

$childes = scandir($dir);
printRWithBr($childes); // 输出: 目录下的所有文件和目录

//web
//定义userInfo 多维关联数组
//键key 字段
echoHr();
$userInfo = [
    'name' => 'albert',
    'nickname' => 'yrhg',
    'age' => 30,
    'avatar' => 'https://albert.com/avatar.jpg',
    'email' => 'test@example.com',
    'phone' => '1234567890',
    'address' => '123 Main St, City, Country',
    'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'website' => 'https://example.com',
    'social' => [
        'facebook' => 'https://facebook.com/albert',
        'twitter' => 'https://twitter.com/albert',
        'linkedin' => 'https://linkedin.com/in/albert',
    ],//社交 子数组
    'skills' => [
        'PHP',
        'JavaScript',
        'HTML',
        'CSS',
        'MySQL',
    ], //技能+索引
    'projects' => [
        [
            'title' => 'Project 1',
            'description' => 'Description of project 1.',
            'url' => 'https://example.com/project1',
        ],//项目
        [
            'title' => 'Project 2',
            'description' => 'Description of project 2.',
            'url' => 'https://example.com/project2',
        ],//职称
    ],
    'education' => [
        [
            'degree' => 'Bachelor of Science in Computer Science',
            'institution' => 'University of Example',
            'year' => 2015,
        ],//教育
        [
            'degree' => 'Master of Science in Software Engineering',
            'institution' => 'Example University',
            'year' => 2017,
        ],
    ],
];

// 使用 json_encode() 将数组转换为 JSON 字符串
echoWithBr(json_encode($userInfo));//把userInfo的数组通过json_encode()转化成字符串
//JSON_PRETTY_PRINT 缩进换行 ；JSON_UNESCAPED_SLASHES 不转译斜杠；JSON_UNESCAPED_UNICODE 不改变编码显示中文
$jsonString = json_encode($userInfo, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
echoWithBr("<pre>$jsonString</pre>");

$userInfoJson = '{"name":"Elon Musk","nickname":"\u9a6c\u4e66\u8bb0",
"age":30,"avatar":"https:\/\/example.com\/avatar.jpg",
"email":"test@example.com","phone":"1234567890","address":"123 Main St, City, Country",
"bio":"Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
"website":"https:\/\/example.com","social":{"facebook":"https:\/\/facebook.com\/elonmusk","twitter":"https:\/\/twitter.com\/elonmusk","
linkedin":"https:\/\/linkedin.com\/in\/elonmusk"},"skills":["PHP","JavaScript","HTML","CSS","MySQL"],"projects":[{"title":"Project 1",
"description":"Description of project 1.","url":"https:\/\/example.com\/project1"},{"title":"Project 2","description":"Description of project 2.",
"url":"https:\/\/example.com\/project2"}],"education":[{"degree":"Bachelor of Science in Computer Science","institution":"University of Example","year":2015},
{"degree":"Master of Science in Software Engineering","institution":"Example University","year":2017}]}';
//直接复制
// 使用 json_decode() 将 JSON 字符串转换为 PHP 数组
$userInfoArray = json_decode($userInfoJson, true);
echo "<pre>";
printRWithBr($userInfoArray); // 输出: 数组
echo "</pre>";
echoWithBr($userInfoArray['nickname']); // 输出: 马书记