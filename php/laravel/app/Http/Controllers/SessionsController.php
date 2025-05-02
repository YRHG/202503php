<?php

namespace app\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
//use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redirect;
use JetBrains\PhpStorm\NoReturn;

class SessionsController extends Controller
{
    /**
     * Show the login form.
     *
     * @return Factory|Application|View
     * /
     *
     */
      public function create(): View|Application|Factory
    {
         return view('sessions.login');
     }


 #[NoReturn] public function store(Request $request): void
{
    dd($request->all());
    #todo validate the request and log the user in
}

/**
 * Log the user out and redirect to the login page.
 *
 * @return Application|Redirector|RedirectResponse
 *
 */
 public function destroy(): Application|Redirect|RedirectResponse
{
    auth()->logout();
    return redirect('/login');
}
}

