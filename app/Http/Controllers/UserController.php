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

    public function loggedInUserData()
    {
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

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('profileImg')) {
            $avatarPath = $request->file('profileImg')->store('img', 'public');
            $user->profileImg = '/storage/' . $avatarPath;
        }

        $user->firstName = $request->input('firstName');
        $user->middleName = $request->input('middleName');
        $user->lastName = $request->input('lastName');
        $user->occupation = $request->input('occupation');
        $user->address = $request->input('address');
        $user->phoneNo = $request->input('phoneNo');
        $user->email = $request->input('email');

        if ($user->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Update successfull',
            ]);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Update unsuccessfull',
        ]);
    }

    public function clients() {

        $clients = User::where('role', 'client')
        ->get();

        return response()->json($clients);
    }

    public function agents() {

        $agents = User::where('role', 'agent')
        ->get();

        return response()->json($agents);
    }
}
