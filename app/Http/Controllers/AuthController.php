<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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

            $token = $emailExists->createToken('31C073W')->plainTextToken;

            $role = '23N';

            if ($emailExists->role == 'admin') {
                $role = '31C';
            }

            if ($emailExists->role == 'agent') {
                $role = '07';
            }

            if ($emailExists->role == 'client') {
                $role = '3W';
            }

            return response()->json([
                'status' => 200,
                'message' => 'Password and Email Matched',
                'role' => $role,
                'token' => $token
            ]);
        } catch (\Throwable $error) {
            return response()->json([
                'status' => 500,
                'message' => $error->getMessage()
            ]);
        }
    }

    public function register(Request $request)
    {

        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|string',
            'password' => 'required|confirmed',
            'address' => 'required|string',
            'phoneNo' => 'required|string',
        ]);

        $register = User::create($validated);

        if ($register) {
            return response()->json([
                'status' => 200,
                'message' => 'Registered successfully'
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Registration failed'
        ]);
    }

    public function logout(Request $request)
    {
        try {

            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found'
                ]);
            }

            $tokens = $user->tokens;

            foreach ($tokens as $token) {
                $token->delete();
            }

            return response()->json([
                'status' => 200,
                'message' => 'Logout Successful'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logins()
    {
        $logins = Auth::user();

        return response()->json([
            'status' => 200,
            'message' => 'User Found',
            'data' => $logins
        ]);
    }

    public function changePassword(Request $request)
    {

        $user = Auth::user();

        $currentPass = $request->input('currentPassword');
        if (!Hash::check($currentPass, $user->password)) {
            return response()->json([
                'status' => 500,
                'message' => 'Password does not match',
            ]);
        }

        $user->password = Hash::make($request->input('newPassword'));

        if ($user->save()) {

            return response()->json([
                'status' => 200,
                'message' => 'Password updated successfully',
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Password update error!',
            'data' => $request->currentPassword
        ]);
    }
}
