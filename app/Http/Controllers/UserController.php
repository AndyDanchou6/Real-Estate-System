<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => $validated->errors()
                ]);
            }

            $emailExists = User::where('email', $request->email)->first();

            if (!$emailExists) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid email address'
                ]);
            }

            $passwordMatched = Hash::check($request->password, $emailExists->password);

            if (!$passwordMatched) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Incorrect password'
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Password and Email Matched',
                'user' => $emailExists
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
}
