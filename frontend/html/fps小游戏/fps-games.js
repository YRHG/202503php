const startButton = document.getElementById('startButton');
const gameArea = document.getElementById('gameArea');
const currentTimeSpan = document.getElementById('currentTime');
const bestTimeSpan = document.getElementById('bestTime');

let startTime;
let timeoutId;
let isWaiting = false;
let bestTime = localStorage.getItem('bestTime') || Infinity;

// 初始化显示最佳成绩
bestTimeSpan.textContent = bestTime === Infinity ? '--' : bestTime;

startButton.addEventListener('click', startGame);
gameArea.addEventListener('click', handleGameAreaClick);

function startGame() {
    startButton.disabled = true;
    gameArea.style.backgroundColor = '#ff4444';
    gameArea.textContent = '等待变绿...';
    isWaiting = true;

    // 设置1-3秒的随机延迟
    const delay = Math.random() * 2000 + 1000; // 1-3秒
    timeoutId = setTimeout(() => {
        gameArea.style.backgroundColor = '#4CAF50';
        gameArea.textContent = '点击！';
        startTime = Date.now();
        isWaiting = false;
    }, delay);
}

function handleGameAreaClick() {
    if (isWaiting) {
        gameArea.textContent = '点得太早了！';
        clearTimeout(timeoutId);
        resetGame();
        return;
    }

    if (!startTime) return;

    const reactionTime = Date.now() - startTime;
    currentTimeSpan.textContent = reactionTime;

    if (reactionTime < bestTime) {
        bestTime = reactionTime;
        localStorage.setItem('bestTime', bestTime);
        bestTimeSpan.textContent = bestTime;
    }

    resetGame();
}

function resetGame() {
    startButton.disabled = false;
    isWaiting = false;
    startTime = null;
    setTimeout(() => {
        gameArea.style.backgroundColor = '#ff4444';
        gameArea.textContent = '点击开始游戏';
    }, 1000);
}
// 广告栏关闭功能
const adBanner = document.getElementById('adBanner');
document.querySelector('.close-ad').addEventListener('click', () => {
    adBanner.style.display = 'none';
    document.body.style.paddingBottom = '0'; // 移除底部padding
});

// 原有游戏逻辑保持不变...

// 扩展点：可在此添加导航栏交互
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        // 预留导航功能扩展
        console.log('导航到：', e.target.textContent);
    });
});

// 历史记录功能
const historyList = document.getElementById('historyList');
const clearHistoryBtn = document.getElementById('clearHistory');

// 初始化历史记录
let gameHistory = JSON.parse(localStorage.getItem('reactionHistory') || '[]');
updateHistoryDisplay();

// 保存记录函数
function saveRecord(time) {
    const record = {
        timestamp: new Date().toISOString(),
        reactionTime: time
    };
    
    gameHistory.unshift(record); // 最新记录放在前面
    localStorage.setItem('reactionHistory', JSON.stringify(gameHistory));
    updateHistoryDisplay();
    
    // 自动更新最佳成绩
    if (time < bestTime) {
        bestTime = time;
        localStorage.setItem('bestTime', bestTime);
        bestTimeSpan.textContent = bestTime;
    }
}

// 更新历史显示
function updateHistoryDisplay() {
    historyList.innerHTML = gameHistory.length > 0 
        ? gameHistory.map((record, index) => `
            <div class="history-item">
                <span>#${index + 1}</span>
                <span>${record.reactionTime} ms</span>
                <span class="timestamp">${new Date(record.timestamp).toLocaleString()}</span>
            </div>
        `).join('')
        : '<div>暂无记录</div>';
}

// 清除历史功能
clearHistoryBtn.addEventListener('click', () => {
    if (confirm('确定要清除所有历史记录吗？')) {
        localStorage.removeItem('reactionHistory');
        gameHistory = [];
        updateHistoryDisplay();
        // 同时重置最佳成绩
        localStorage.removeItem('bestTime');
        bestTime = Infinity;
        bestTimeSpan.textContent = '--';
    }
});

// 修改原有handleGameAreaClick函数
function handleGameAreaClick() {
    // ...原有逻辑保持不变...

    const reactionTime = Date.now() - startTime;
    currentTimeSpan.textContent = reactionTime;
    saveRecord(reactionTime); // 替换原来的最佳成绩更新逻辑

    resetGame();
}

