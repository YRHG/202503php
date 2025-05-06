<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(): Factory|Application|View
    {
        $data = [
            'name' => 'Laravel.中间件.控制器',
            'version' => '12.x',
            'master' => 'Albert Han',
        ];

        $master = $data['master'];

        $categories = Categories::paginate($this->perPage);

        $html = '<h1 class="text-4xl">Welcome home sir</h1>';

        // session()->flash('success', 'This is a flash message!');

        return view('test.index', compact('data', 'master', 'categories', 'html'));
    }
}
