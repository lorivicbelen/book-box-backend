<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'string|max:255|required',
            'email' => 'string|email|max:255|required',
            'password' => 'string|min:8|required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json(
            [
                'message' => 'Jen test',
                'user' => $user
            ],
            200
        );
    }
}
