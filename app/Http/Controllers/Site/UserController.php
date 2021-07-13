<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Country;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register() {
        $data['title'] = 'Register';
        $data['countries'] = Country::all();
        $data['bg'] = asset('site/img/images/register.jpg');
        return view('site.pages.register')->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login() {
        $data['title'] = 'Login';
        return view('site.pages.login')->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notVerified($id) {
        $user = User::findOrFail($id);
        if ($user) {
            $data['title'] = 'Not Verified';
            return view('site.pages.not-verified')->with($data);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verified() {
        $data['title'] = 'Verified';
        return view('site.pages.verified')->with($data);
    }
}
