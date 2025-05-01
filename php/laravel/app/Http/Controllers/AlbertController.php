<?php

namespace app\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AlbertController extends Controller
{
    /**
     * @return Factory|Application|View
     */
    public function index(): Factory|Application|View
    {
        return view('albert.index');
    }

    public function login(): Factory|Application|View
    {
        return view('albert.login');
    }
}
