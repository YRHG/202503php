// script.js
function calculateBMI() {
    // weight&height
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value);

    // 输入
    if (isNaN(weight)) {
        alert("请输入有效体重");
        return;
    }
    if (isNaN(height) || height <= 0) {
        alert("请输入有效身高");
        return;
    }

    // 计算 BMI
    const bmi = weight / (height * height);
    const resultElement = document.getElementById('result');

    // 计算结果result
    resultElement.value = `BMI: ${bmi.toFixed(1)}`;
}
// 新增初始化函数
function initGreeting() {
    const greeting = document.getElementById('greeting');
    greeting.textContent = '陛下万岁万岁万万岁';
}

// 页面加载时执行
window.onload = function() {
    initGreeting();
