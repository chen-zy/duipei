<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function upload(Request $request)
    {
        $files = [];
        foreach ($request->files as $key => $file) {
            $file = $request->file($key)->store('uploads');
            $files[] = Storage::url($file);
        }

        return response()->json(compact('files'));
    }
}
