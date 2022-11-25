<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Formation_degree;

class FormationDegree extends Controller
{
    //***********Formation_degree
    
    public function create_formation_degree(Request $req)
    {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
                'id_formation' => 'required|integer',
                'id_degree' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        
        $data = Formation_degree::create($req->all());

        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'formation degree SUCCESFULLY SAVED',
                'Formationdegree'=>$data
              ]);
             }
         }
     }catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_formation_degree($id)
    {
    try{
         $selected=formation_degree::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'Formation degree'=>$selected
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

    public function update_formation_degree(Request $req,Formation_degree $Formation_degree)
    {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
                'id_formation' => 'integer',
                'id_degree' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        
        $Formation_degree->update($req->all());

        if (!$Formation_degree) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'formation SUCCESFULLY Updated',
                'Formation degree'=>$Formation_degree
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_formation_degree(Request $req,Formation_degree $Formation_degree)
    {
        try{
        $deleted = $Formation_degree->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'formation SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_formation_degrees()
    {
    try{
         $itype=formation_degree::orderBy('id', 'desc')->paginate(50);
            if(isset($itype))
            {
                return response()->json([
                    'formation degree'=>$itype
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
