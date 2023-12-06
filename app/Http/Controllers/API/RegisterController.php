<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;
use DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Auth\RegisterRequest;
use Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'email|required|unique:users,email',
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return response()->json(['isSuccessful' => false, 'data' => '', 'error' => $validator->errors()], 404);
    } else {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        // Create the user
        $user = User::create($input);

        if (!$user) {
            // Log or handle the error if user creation fails
            return response()->json(['isSuccessful' => false, 'data' => '', 'error' => 'User creation failed'], 500);
        }

        // Generate token
        $accessToken = $user->createToken('MyApp')->plainTextToken;

        if (!$accessToken) {
            // Log or handle the error if token creation fails
            return response()->json(['isSuccessful' => false, 'data' => '', 'error' => 'Token creation failed'], 500);
        }

        // Return success response with user data and token
        return response()->json(['isSuccessful' => true, 'data' => $user, 'accessToken' => $accessToken, 'message' => 'User added successfully'], 200);
    }
}

}
