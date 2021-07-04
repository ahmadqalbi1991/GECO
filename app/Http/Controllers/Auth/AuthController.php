<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();
        unset($input['_token']);
        if (Auth::attempt($input)) {
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('site.login');
            }
        } else {
            $data['error'] = 'fail';
            return redirect()->back()->withErrors(['login_fail' => 'Please check login details.']);
        }
    }
}
