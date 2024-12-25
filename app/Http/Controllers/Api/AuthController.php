<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
      // Register a new user
      public function register(Request $request)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:6|confirmed',
          ]);
  
          $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => Hash::make($request->password),
          ]);
  
          return response()->json(['message' => 'User created successfully'], 201);
      }
  
      // Login a user and generate a token
      public function login(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required|string',
          ]);
  
          $user = User::where('email', $request->email)->first();
  
          if (!$user || !Hash::check($request->password, $user->password)) {
              return response()->json(['message' => 'Invalid credentials'], 401);
          }
  
          // Generate a token (using simple string token for now)
          $token = Str::random(60);
  
          // Save the token to your API tokens table or user record (for simplicity, we’re using a custom column in the user table)
          $user->api_token = $token;
          $user->save();
  
          return response()->json(['token' => $token], 200);
      }
  
      // Get authenticated user
      public function user(Request $request)
      {
          return response()->json($request->user());
      }
  
      // Logout and invalidate token
      public function logout(Request $request)
      {
          $user = $request->user();
          $user->api_token = null; // Clear the token
          $user->save();
  
          return response()->json(['message' => 'Logged out successfully'], 200);
      }

}
