<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Socialite;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation rules for registration
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'country_code' => 'required',
            'mobile_number' => 'required',
            'is_accepted_policy' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors(), 'status'=> 400], 400);
        }

        // Create and save the user
        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'country_code' => $request->country_code,
            'mobile_number' => $request->mobile_number,
            'is_accepted_policy' => $request->is_accepted_policy,
        ]);
        $user->save();

        // Return a success message
        return response()->json(['message' => 'Registration successful', 'status' => 201, 'data' => $user], 201);
    }

    public function login(Request $request)
    {
        // Validation rules for login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 400],400);
        }

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
            return response()->json(['data' => $user, 'access_token' => $token, 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials', 'status' => 401], 401);
        }
    }


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback($provider)
    {
        // dd($provider);
        try {
            $user = Socialite::driver($provider)->user();
            $findUser = User::where($provider.'_id', $user->user['id'])->first();
            if ($findUser) {
                Auth::login($findUser);
                return response()->json(['data' => $findUser, 'status' => 200], 200);
            } else {
                $newUser = new User([
                    'email' => $user->user['email'],
                    $provider.'_id' => $user->user['id'],
                    'is_accepted_policy' => 1,
                    'login_type' => 1,
                    'email_verified' => $user->user['email_verified']
                ]);
                $newUser->save();
                Auth::login($newUser);
                return response()->json(['data' => $newUser, 'status' => 200], 200);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        // $userSocial =   Socialite::driver($provider)->user();
        // // json_encode($userSocial,true);
        // dd($userSocial->user);
    }

    public function username(Request $request){
        $validator = Validator::make($request->all(), [
            'social_id' => 'required',
            'username' => 'required|string|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors(), 'status'=> 400], 400);
        }

        User::where('google_id', $request->social_id)
            ->orWhere('facebook_id', $request->social_id)
            ->update(['username'=> $request->username]);

        return 'success';
    }
}
