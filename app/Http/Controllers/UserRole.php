<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_role;
use Illuminate\Support\Facades\Validator;

class UserRole extends Controller
{
    
 //***********User_role

     public function create_User_role(Request $req)
    {
    try {
        //create validation
            $validate = Validator::make($req->all(), [
                'id_user' => 'required|integer',
                'id_role' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data= User_role::create($req->all());
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
                'User role'=>$data

              ]);
             }}
             } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function delete_User_role(Request $req,User_role $User_role)
    {
    try{
        $deleted = $User_role->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'User role SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

     public function update_User_role(Request $req, User_role $User_role)
     {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
                'id_user' => 'integer',
                'id_role' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $up= $User_role->update($req->all()); 
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
                'User role'=>$User_role
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function read_User_role( $id)
    {
    try{
         $selected= User_role::findOrFail($id);
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

    public function show_User_roles()
    {
    try{
         $ist= User_role::orderBy('id', 'desc')->paginate(50);
            if(isset($ist))
            {
                return response()->json([
                    'User roles'=>$ist
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
