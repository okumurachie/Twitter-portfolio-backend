<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateName(Request $request)
    {
        $user = $request->user();
        $user->name = $request->input('name');
        $user->save();

        return response()->json(['message' => 'OK']);
    }
}
