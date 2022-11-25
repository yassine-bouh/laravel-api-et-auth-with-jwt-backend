<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Degree;

class DegreeController extends Controller
{
    
       
    //***********Degree

    public function create_degree(Request $req)
    {
        try{
    
        //create validation
            $validate = Validator::make($req->all(), [
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'level' => 'required|string|max:255',
               
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {       
        $Degree = Degree::create($req->all());

        if (!$Degree) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
               'status'=>200,
                'message'=>' degree SUCCESFULLY SAVED',
		'degree'=>$Degree  

              ]);
             }
           }
         } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_degree($id)
    {
    try{
         $selected=degree::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'degrees'=>$selected
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

    public function update_degree(Request $req,Degree $Degree)
    {
    try{    
    //create validation
            $validate = Validator::make($req->all(), [
                'name' => 'string|max:255',
                'resume' => 'string|max:255',
                'level' => 'string|max:255',
               
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {  
        $updated=$Degree->update($req->all());

        if (!$updated) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'degree SUCCESFULLY Updated',
                'Degree'=>$Degree
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_degree(Request $req,Degree $Degree)
    {
    try{
        $deleted = $Degree->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'degree SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_degrees()
    {
    try{
         $degree=degree::orderBy('id', 'desc')->paginate(50);
            if(isset($degree))
            {
                return response()->json([
                    'degrees'=>$degree
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
