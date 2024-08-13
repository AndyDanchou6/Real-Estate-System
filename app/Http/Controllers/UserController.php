<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function allUsers()
    {
        $users = User::all();

        if (!$users) {
            return response()->json([
                'status' => 404,
                'message' => 'No Users Found'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Users Found',
                'data' => $users
            ]);
        }
    }

    public function loggedInUserData() {
        $userData = Auth::user();

        if (!$userData) {
            return response()->json([
                'status' => 404,
                'message' => 'User Not Found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'User data found',
            'data' => $userData
        ]);
    }
}
