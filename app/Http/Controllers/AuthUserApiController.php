<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserApiController extends Controller
{
	public function login(AuthRequest $request)
	{

		// Chech credentials
		$user = User::where('email', $request->email)->first();
		if (!$user) return response()->json($this->handleMessage(401), 401);

		if (!Hash::check($request->password, $user->password)) return response()->json($this->handleMessage(401), 401);

		// Create token
		$token = $user->createToken('auth_token')->plainTextToken;

		// handleToken
		$data = ['access_token' => $token];
		return response()->json($this->handleMessage(200, $data), 200);
	}

	public function logout(Request $request)
	{
		/** @var \App\Models\User\User $user */
		$user  = Auth::user();
		$user->tokens()->delete();
		if (!$request->ajax()) return view('/');
		return response()->json([], 204);
	}
	public function profile()
	{
		return response()->json(['auth_user' => Auth::user()], 200);
	}

	private function handleMessage($code, $data = null)
	{
		switch ($code) {
			case 401:
				return ['Login' => false, 'message' => 'Password or email not valid'];

			default:
				return ['Login' => true, 'message' => 'login successful', 'data' => $data];
		}
	}
}
