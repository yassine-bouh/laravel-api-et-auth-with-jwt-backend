<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //***********Role

     public function create_Role(Request $req)
    {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
               'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                 
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data= Role::create($req->all());
        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'Role SUCCESFULLY SAVED',
                'Role'=>$data

              ]);
             }}
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }     

    }

    public function delete_Role(Request $req,Role $Role)
    {
    try{
        $deleted = $Role->delete();
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

     public function update_Role(Request $req, Role $Role)
     {
    try{
       //create validation
            $validate = Validator::make($req->all(), [
                'name' => 'string|max:255',
                'description' => 'string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $up= $Role->update($req->all()); 
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
                'Role'=>$Role
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function read_Role( $id)
    {
    try{
         $selected= Role::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'Role'=>$selected
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

    public function show_Roles()
    {
    try{
         $ist= Role::orderBy('id', 'desc')->paginate(50);
            if(isset($ist))
            {
                return response()->json([
                    'Roles'=>$ist
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
