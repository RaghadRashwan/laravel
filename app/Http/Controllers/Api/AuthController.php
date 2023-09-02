<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
          $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
          ]);

         $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->plainTextToken;

        return ['user' => $user, 'access_token' => $accessToken];

    }

    public function login(Request $request) {
      $validatedData = $request->validate([
          'email' => 'required',
          'password' => 'required',
      ]);
  
      if (!auth()->attempt($validatedData)) {
          return response()->json(['message' => 'invalid login details'], 401);
      }
       
      $user = User::find(auth()->user()->id);
      $accessToken = $user->createToken('authToken')->plainTextToken;
  
      return ['user' => auth()->user(), 'access_token' => $accessToken];
  }
  
}
