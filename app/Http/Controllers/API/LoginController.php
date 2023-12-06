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
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
     public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ['email' => 'required', 'password' => 'required']);

            if ($validator->fails()) {
                $responseCode = Response::HTTP_BAD_REQUEST;
                $responseData = $validator->errors();
                $responseMessage = 'Validation Error';
            } else {
                if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                    $user = Auth::user();
                    $token = $user->createToken('MyApp')->plainTextToken;

                    $responseCode = Response::HTTP_OK;
                    $responseData = ['user' => $user, 'access_token' => $token];
                    $responseMessage = 'Successfully Login';
                } else {
                    $responseCode = Response::HTTP_UNAUTHORIZED;
                    $responseData = (object) [];
                    $responseMessage = 'Provided Credentials are Wrong';
                }
            }
        } catch (\Exception $e) {
            $responseCode = Response::HTTP_EXPECTATION_FAILED;
            $responseData = (object) [];
            $responseMessage = $e->getMessage();
        }

        return ResponseHelper::returnResponse($responseCode, $responseMessage, $responseData);
    }
}






