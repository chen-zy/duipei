<?php

namespace App\Http\Controllers\Admin;

use App\Rules\Mobile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Krucas\Notification\Facades\Notification;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', new Mobile, 'unique:users'],
            'password' => ['required'],
            'roles' => ['array']
        ]);

        try {
            DB::beginTransaction();

            $user = new User;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->save();

            if ($request->has('roles')) {
                $user->attachRoles($request->roles);
            }

            DB::commit();
            Notification::success('用户创建成功');

            return redirect()->route('admin.user.create');
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("用户创建失败[{$e->getMessage()}]");
            return redirect()->route('admin.user.create');
        }
    }

    public function edit($id)
    {
        $user = User::findBySlugOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findBySlugOrFail($id);

        $this->validate($request, [
            'mobile' => ['required', new Mobile, Rule::unique('users')->ignore($user->id)],
            'roles' => ['array']
        ]);

        try {
            DB::beginTransaction();

            $user->mobile = $request->mobile;

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $user->roles()->sync([]);
            if ($request->has('roles')) {
                $user->attachRoles($request->roles);
            }

            DB::commit();
            Notification::success('用户编辑成功');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("用户编辑失败[{$e->getMessage()}]");
        }

        return redirect()->route('admin.user.edit', $user);
    }

}
