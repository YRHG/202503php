<?php

namespace app\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application|
     *
     */public function home(Request $request):Factory|View|Application
    {
        return view('index.home');
    }
}
