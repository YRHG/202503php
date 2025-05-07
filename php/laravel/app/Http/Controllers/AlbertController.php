<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\LoginRecord;
use App\Models\Work;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbertController extends Controller
{
    public function index(): Factory|Application|View
    {
        return view('albert.index');
    }

    public function login(): Factory|Application|View
    {
        return view('albert.login');
    }

    //  用户留言
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return redirect()->back()->with('success', '留言成功！');
    }

    //  查看登录记录
    public function loginRecords(): Factory|Application|View
    {
        $records = LoginRecord::where('user_id', Auth::id())->latest()->get();
        return view('albert.login_records', compact('records'));
    }

    //  管理员软删除留言
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::user()->isAdmin()) {
            $post->delete();
            return redirect()->back()->with('success', '留言已删除');
        }

        abort(403);
    }

    //  超级管理员上传作品
    public function uploadWork(Request $request)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('works', 'public')
            : null;

        Work::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $path,
        ]);

        return redirect()->back()->with('success', '作品上传成功');
    }
}
