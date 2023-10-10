<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserLanguage;
use App\Models\UserInterest;

class UsersController extends Controller
{
    public function profileRequired(Request $request){
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'primary_language' => 'required',
            'location' => 'required',
            'profile_image' => 'required|mimes:jpg,png,jpeg,gif,svg,webp',
            'banner_image' => 'required|mimes:jpg,png,jpeg,gif,svg,webp',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors(), 'status'=> 400], 400);
        }

        $findRecord = UserProfile::where('user_id', $request->user_id)->first();
        if ($findRecord) {
            return response()->json(['message' => 'User Profile Data Already Exist!', 'status' => 400], 400);
        } else {
            // Create and save the User Profile
            $userProfile = new UserProfile([
                'user_id' => $request->user_id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'birthdate' => date("Y-m-d", strtotime($request->birthdate)),
                'location' => $request->location,
                'profile_image' => $request->profile_image,
                'profile_image_thumbnail' => $request->profile_image,
                'banner_image' => $request->banner_image,
            ]);
            $userProfile->save();

            $userLanguage = new UserLanguage([
                'user_profile_id' => $userProfile->id,
                'primary_language' => $request->primary_language,
                'additional_language_1' => $request->additional_language_1 ? $request->additional_language_1 : NULL,
                'additional_language_2' => $request->additional_language_2 ? $request->additional_language_2 : NULL,
                'additional_language_3' => $request->additional_language_3 ? $request->additional_language_3 : NULL,
            ]);

            $userLanguage->save();

            $userInterest = new UserInterest([
                'user_profile_id' => $userProfile->id,
                'interest' => $request->primary_language,
                'interest_1' => $request->interest_1 ? $request->interest_1 : NULL,
                'interest_2' => $request->interest_2 ? $request->interest_2 : NULL,
                'interest_3' => $request->interest_3 ? $request->interest_3 : NULL,
            ]);

            $userInterest->save();


            // Return a success message
            return response()->json(['message' => 'User Profile Created!', 'status' => 201, 'data' => $userProfile], 201);
        }
    }


    public function profileOptional(Request $request){

    }

    public function testing(){
        $data = User::with('userProfile.userLanguage','userProfile.userInterest')->where('id',1)->get();
        dd($data);
    }
}
