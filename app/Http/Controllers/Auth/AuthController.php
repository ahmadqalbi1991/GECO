<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
                if (!Auth::user()->verified) {
                    $user_id = Auth::id();
                    Auth::logout();
                    return redirect()->route('site.user.not_verified', $user_id);
                } else {
                    return redirect()->route('site.home');
                }
            }
        } else {
            $data['error'] = 'fail';
            return redirect()->back()->withErrors(['login_fail' => 'Please check login details.']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request) {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'username' => 'required|unique:users',
            'confirm_password' => 'required|same:password',
            'terms' => 'required',
            'country' => 'required'
        ]);


        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation);
        }

        $input = $request->all();
        $data['name'] = $input['first_name'] . ' ' . $input['last_name'];
        $data['email'] = $input['email'];
        $data['password'] = bcrypt($input['password']);
        $data['username'] = $input['username'];
        $data['country_id'] = $input['country'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $image_name = 'user_' . time() . '.' . $extension;
            $destinantion = public_path() . '/';
            $image->move($destinantion, $image_name);
        } else {
            $image_name =  NULL;
        }

        $data['image'] = $image_name;
        $code = Str::random(20);
        $data['email_code'] = $code;

        $result = User::insertGetId($data);
        if ($result) {
            $email_data['user_id'] = $result;
            $email_data['code'] = $code;

            Mail::send('email_templates.register', $email_data, function ($message) use($input) {
                $message->subject("Registration Successfull");
                $message->from('admin@admin.com', 'GECO ADMIN');
                $message->to($input['email']);
            });
            return redirect()->back()->with(['status' => 'success', 'message' => 'Registration Complete. Please check your email address for verification']);
        } else {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong']);
        }
    }

    /**
     * @param $code
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($code, $id) {
        $user = User::where(['id' => $id, 'email_code' => $code])->first();
        if ($user) {
            $user->email_code = '';
            $user->verified = 1;
            if ($user->save()) {
                return redirect()->route('site.user.verified');
            } else {
                return redirect()->route('site.home');
            }
        } else {
            abort(404);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
        return redirect()->back();
    }
}
