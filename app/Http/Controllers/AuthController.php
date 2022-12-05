<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {

    public function register(Request $request) {

        try {

            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'User Sucsessfuly Created',
                'message_key' => 'user_created',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);



        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function registerAdmin(Request $request) {

        try {

            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'formCountry' => 'required',
                'isSuper' => 'required',
            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'country' => $request->formCountry,
                'password' => Hash::make($request->password),
                'isSuper' => $request->isSuper,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'User Sucsessfuly Created',
                'message_key' => 'user_created',
                
            ], 200);



        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request) {

        try {

            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed'
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Login Failed',
                    'message_key' => 'invalid_credentials',
                    'errors' => $validateUser->errors()
                ], 200);
            }

            return response()->json([
                'error' => false,
                'user_data' => $user,
                'message' => 'User Sucsessfuly Created',
                'message_key' => 'user_created',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);



        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }


    public function getAllUsers() {

        try {

            $users = User::all();

            return response()->json([
                'error' => false,
                'data' => $users
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getAdmins() {

        try {

            $users = User::where('isSuper', '=', '0')->get();

            return response()->json([
                'error' => false,
                'data' => $users
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request){
        try {
            
            $user = request()->user(); //or Auth::user()
            // Revoke current user token
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'error' => false,
                'message' => 'User Sucessfult lougout',
                'message_key' => 'user_logout',
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteAdmin(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'adminId'=> 'required',

            ]);


            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $admin = User::find($request->adminId);
            $done=$admin->delete();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Deleted',
                'response'=> $done,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateAdmin(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                

            ]);

           

            
            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $data = User::find($request->dataId);
            $data->name = request('name');
            $data->email = request('email');
            $data->country = request('formCountry');
            

            $dat=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $dat,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePassword(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                'password'=>'required',
               
                

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $data = User::find($request->dataId);
            $data->password = Hash::make($request->password);

            $dat=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $dat,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getPersonalDetails(){
        try {

                $userDetails = auth()->user();
                
                $data = User::where('id','=', $userDetails->id)->get();
                   
            return response()->json([
                'error' => false,
                'data' => $data,
            
                
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePersonalDetails(Request $request){
        try{

            
            $validateUser = Validator::make($request->all(), [
                'dataId'=> 'required',
                
               
                

            ]);

            if($validateUser->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation Failed',
                    'message_key' => 'validation_failed',
                    'errors' => $validateUser->errors()
                ], 200);
            }

           
            $data = User::find($request->dataId);
            $data->name = request('name');
            $data->email = request('email');

            $dat=$data->save();

            return response()->json([
                'error' => false,
                'message_key' => 'record_update',
                'message' => 'Record Sucessfully Updated',
                'response'=> $dat,
            ], 200);

        }

        catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Some Internal Server Error Occured',
                'message_key' => 'internal_error',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
