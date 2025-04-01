// bmi计算
function calculateBMI() {
    let weight = parseFloat(document.getElementById('weight').value);
    let height = parseFloat(document.getElementById('height').value);

    // 输入验证
    if (isNaN(weight) || weight <= 20) {
        alert("请输入有效体重（至少 20kg)"); // 英文半角 )
        return;
    }

    if (isNaN(height) || height <= 100) {
        alert("请输入有效身高（至少 100cm)"); // 英文半角 )
        return;
    }

    // 计算 BMI
    let bmi = weight / (height * height) * 10000;
    bmi = bmi.toFixed(2);

    // 显示结果（统一使用中文全角括号，确保成对）
    let resultElement = document.getElementById('result');
    if (bmi < 18.5) {
        resultElement.value = `BMI: ${bmi}（体重过轻）`; // 全角括号
    } else if (bmi < 24) {
        resultElement.value = `BMI: ${bmi}（体重正常）`;
    } else if (bmi < 28) {
        resultElement.value = `BMI: ${bmi}（体重过重）`;
    } else if (bmi < 35) {
        resultElement.value = `BMI: ${bmi}（肥胖）`;
    } else {
        resultElement.value = `BMI: ${bmi}（非常肥胖）`;
    }
}
// 事件监听
document.getElementById('calculateBMI').addEventListener('click', calculateBMI);

// 新增初始化函数
function initGreeting() {
    const greeting = document.getElementById('greeting');
    greeting.textContent = '陛下万岁万岁万万岁';
}

// 页面加载时执行
window.onload = function() {
    initGreeting();
}
// 有种逮到我
const box = document.getElementById('escape');
// 起始点
setRandomPosition(box);
// 鼠标触发事件
 box.addEventListener('mouseover', () => {
     setRandomPosition(box);
}
// 逃跑方式 
function function setRandomPosition(element) {
    if (isMoving) return;
    isMoving = true;
}
// 新位置计算50
const newX = Math.max(50, Math.min(safeWidth - 50, 
    Math.random() * safeWidth));
  const newY = Math.max(50, Math.min(safeHeight - 50, 
    Math.random() * safeHeight));
    box.style.left = newX + 'px';
    box.style.top = newY + 'px';

