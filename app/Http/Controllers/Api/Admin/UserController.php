<?php

namespace App\Http\Controllers\Api\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC');

        return DataTables::of($users)
            ->addColumn('roles', function ($user) {
                return $user->roles->implode('display_name', ',');
            })
            ->addColumn('actions', function ($user) {
                return '<a href="' . route('admin.user.edit', $user) . '" class="btn btn-xs btn-default" role="button" ma-tab="编辑用户"><i class="fa fa-edit"></i> Edit</a> <button class="btn btn-xs btn-default J_delete" data-id="' . $user->id . '"><i class="fa fa-trash"></i> Delete</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
