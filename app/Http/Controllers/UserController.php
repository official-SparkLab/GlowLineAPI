<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function createUser (Request $request) {


        $validator = Validator::make($request->all(), [
            'user_contact' => 'required|max:10|unique:tbl_users',
            'user_email' => 'required|unique:tbl_users',

            // Add other validation rules for the remaining fields if needed
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            $userErrors = [];
    
            if ($errors->has('user_contact')) {
                $userErrors['user_contact'] = 'The Mobile no has already been taken.';
            }

            if ($errors->has('user_email')) {
                $userErrors['user_email'] = 'The email  has already been taken.';
            }
    
            // Add custom error messages for other fields if needed
    
            return response()->json(['errors' => $userErrors], 422);
        }

        $user = new User;
        $user->user_name = $request->input("user_name");
        $user->user_gender = $request->input("user_gender");
        $user->user_contact = $request->input("user_contact");
        $user->user_email = $request->input("user_email");
        $user->user_password = $request->input("user_password");

        $user->save();

        if($user)
        {
            return response()->json(["Message" => "User saved successfully"]);
        }
        else {
            return response()->json(["Message" => "Failed to save user"]);
        }

    }


    public function fetchUsers()
      {
          $users = User::all();
      
          return response()->json([
              'data' => $users,
          ]);
      }

        // Delete Expense data 
    public function deleteUserData($user_id)
    {
        $user = User::findOrFail($user_id); // Set the status column to 0 (or any other value that represents a deleted/expired status)
        $user->delete();

        return response()->json([
            'message' => 'Record deleted',
        ]);
    }

    public function updateUser(Request $request,$user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }

        $user->user_name = $request->input("user_name");
        $user->user_gender = $request->input("user_gender");
        $user->user_contact = $request->input("user_contact");
        $user->user_email = $request->input("user_email");
        $user->user_password = $request->input("user_password");

        $user->save();

        if($user)
        {
            return response()->json(["Message" => "User updated successfully"]);
        }
        else {
            return response()->json(["Message" => "Failed to update user"]);
        }


    }



    public function fetchDataById($user_id)
    {
        $user = User::find($user_id);
     
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
     
        return response()->json([
            'data' => $user,
        ]);
    }


    public function login(Request $request)
    {
        $user_email = $request->input('user_email');
        $user_password = $request->input('user_password');
    
        // Retrieve the user from the database based on the provided email
        $user = DB::table('tbl_users')->where('user_email', $user_email)->first();
    
        if ($user && $user->user_password === $user_password) {
            // Password matches, so user is authenticated
            return response()->json([
                'name' => $user->user_name,
                'message' => true,
            ], 200);
        } else {
            // Invalid credentials, return unauthorized response
            return response()->json(['message' => false], 401);
        }
    }

}
