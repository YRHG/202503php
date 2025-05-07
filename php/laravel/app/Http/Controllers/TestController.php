<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(): Factory|Application|View
    {
        $data = [
            'name' => 'Laravel',
            'version' => '12.x',
            'author' => 'Albert Han',
        ];

        $author = 'Albert Han';

        $categories = Categories::paginate($this->perPage);


        $products = Products::where('id', '<', 100)
            ->orderBy('id', 'desc')
            ->get();
        $products = Products::findMany([1, 2, 3]);
        $products = Products::where('id', '<', 100)
            ->orderBy('id', 'desc')
            ->get();
        $products = Products::findMany([1, 2, 3]);

        $product = Products::find(2);
        $product->price = 999;


        $html = '<h1 class="text-4xl">Welcome home sir</h1>';



        return view('test.index', compact('data', 'author', 'categories', 'html'));
    }
}
