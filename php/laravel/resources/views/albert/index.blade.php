<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户登录</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #34495e;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #7f8c8d;
            border-radius: 4px;
            background-color: #ecf0f1;
            color: #2c3e50;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #e74c3c;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #c0392b;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .login-box {
                padding: 20px;
                width: 80%;
            }

            h2 {
                font-size: 20px;
            }

            label {
                font-size: 14px;
            }

            input {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-box">
        <h2>用户登录</h2>
        <form action="{{ route('albert.login') }}" method="POST">
            <!-- 用户名和密码字段 -->
            <label for="username">用户名</label>
            <input type="text" id="username" name="username" placeholder="请输入用户名" required>

            <label for="password">密码</label>
            <input type="password" id="password" name="password" placeholder="请输入密码" required>

            <input type="submit" value="登录">
        </form>
    </div>
</div>

<div class="footer">
    <p>  2025 </p>
</div>

</body>
</html>
