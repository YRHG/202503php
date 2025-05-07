<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>Albert 控制面板</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            color-scheme: dark;
        }

        body {
            margin: 0;
            padding: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro", "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #1e1e1e;
            color: #e0e0e0;
            line-height: 1.6;
        }

        h1, h2 {
            color: #ffffff;
        }

        input, textarea, select, button {
            font: inherit;
            background: #2c2c2e;
            border: 1px solid #444;
            border-radius: 6px;
            color: #f0f0f0;
            padding: 0.5rem;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            cursor: pointer;
            background-color: #007aff;
            color: white;
            border: none;
            margin-top: 0.5rem;
        }

        button:hover {
            background-color: #005bb5;
        }

        form {
            margin-bottom: 2rem;
            background: #2b2b2b;
            padding: 1rem;
            border-radius: 10px;
        }

        .record {
            padding: 0.5rem 0;
            border-bottom: 1px solid #444;
        }

        .success {
            background: #2e8b57;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 6px;
        }

        .error {
            background: #a94442;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<h1>Albert 控制面板</h1>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="error">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- 留言表单 -->
<form method="POST" action="{{ route('albert.post.store') }}">
    @csrf
    <h2>留言</h2>
    <textarea name="message" rows="4" placeholder="写下你的留言..."></textarea>
    <button type="submit">提交留言</button>
</form>

<!-- 上传作品表单 -->
<form method="POST" action="{{ route('albert.work.upload') }}" enctype="multipart/form-data">
    @csrf
    <h2>上传作品</h2>
    <input type="text" name="title" placeholder="标题"><br><br>
    <textarea name="content" rows="3" placeholder="作品内容"></textarea><br><br>
    <input type="file" name="image"><br>
    <button type="submit">上传作品</button>
</form>

<!-- 登录记录展示（需配合控制器返回变量 $records） -->
@isset($records)
    <h2>你的登录记录</h2>
    @forelse($records as $record)
        <div class="record">
            IP: {{ $record->ip_address ?? '未知' }} <br>
            浏览器: {{ $record->user_agent ?? '未知' }} <br>
            时间: {{ $record->created_at->format('Y-m-d H:i:s') }}
        </div>
    @empty
        <p>暂无记录。</p>
    @endforelse
@endisset

</body>
</html>
