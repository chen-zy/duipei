<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showLoginForm(Request $request)
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->only(['mobile', 'remember']))
                ->withErrors($validator);
        }

        $mobile = $request->mobile;
        $password = $request->password;
        $remember = $request->remember;

        $user = User::where('mobile', $mobile)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return redirect()->back()
                ->withInput($request->only(['mobile', 'remember']))
                ->withErrors(['mobile' => 'These credentials do not match our records.',]);
        }

        if (!$user->roles()->count()) {
            return redirect()->back()
                ->withInput($request->only(['mobile', 'remember']))
                ->withErrors(['mobile' => 'This user has no permissions.',]);
        }

        auth()->login($user, $remember);

        return redirect()->intended();
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('admin.login');
    }
}
