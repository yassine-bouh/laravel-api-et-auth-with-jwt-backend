<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\User_role;
use Illuminate\Http\Request;

class UserController extends Controller
{
 //***********User

     public function create_User(Request $req)
    {
    try {
        //create validation
            $validate = Validator::make($req->all(), [
                'username' => 'required|string|max:255',
                'password' => 'required|string|max:255',
                'id_role' => 'required|integer',
                'active' => 'required|boolean',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data= User::create([
            'username' => $req->username,
            'active' => $req->active,
            'id_role' => $req->id_role,
            'password' => bcrypt($req->name)]);
        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'User SUCCESFULLY SAVED',
                'User'=>$data

              ]);
             }}
             } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function delete_User(Request $req,User $User)
    {
    try{
        $deleted = $User->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'User SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

     public function update_User(Request $req, User $User)
     {
    try{
       //create validation
            $validate = Validator::make($req->all(), [
                'username' => 'string|max:255',
                'password' => 'string|max:255',
                'id_role' => 'required|integer',
                'active' => 'boolean',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $up= $User->update($req->all()); 
        if (!$up) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'User SUCCESFULLY Updated',
                'User'=>$User
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function read_User( $id)
    {
    try{
         $selected= User::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'User'=>$selected
                ]);
            }
            else 
	        {
                return response()->json([
                    'error'=>'Data Not Found',
                ]);
            }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_Users()
    {
    try{
         $ist= User::orderBy('id', 'desc')->paginate(50);
            if(isset($ist))
            {
                return response()->json([
                    'Users'=>$ist
                ]);
            }
            else 
	        {
                return response()->json([
                    'error'=>'Data Not Found',
                ]);
            }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
 
}
