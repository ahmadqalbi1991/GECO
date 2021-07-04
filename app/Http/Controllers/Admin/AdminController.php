<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(Request $request) {
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect()->route('admin.login');
        }

        $data['title'] = 'Dashboard';
        return view('admin.pages.dashboard')->with($data);
    }

    public function login() {
        $data['title'] = 'Login';
        return view('admin.pages.login')->with($data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
