<?php

require __DIR__ . '/vendor/autoload.php';

use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

$phoneUtil = PhoneNumberUtil::getInstance();

// 假设你有一个电话号码
$number = '+1 650-555-1234';

// 解析号码
$parsedNumber = $phoneUtil->parse($number, "US");

// 格式化号码
$formattedNumber = $phoneUtil->format($parsedNumber, PhoneNumberFormat::E164);

// 输出
echo "原始电话号码: $number\n";
echo "格式化后的电话号码: $formattedNumber\n";
echo "国家代码: " . $parsedNumber->getCountryCode() . "\n";
echo "国家: " . $phoneUtil->getRegionCodeForNumber($parsedNumber) . "\n";
