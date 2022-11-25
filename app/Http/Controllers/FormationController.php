<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\formation;


class FormationController extends Controller
{
     //***********Formation
    
    public function create_formation(Request $req)
    {
        try{
             //create validation
            $validate = Validator::make($req->all(), [
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'conditions' => 'required|string|max:255',
                ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data = Formation::create($req->all());

        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'formation  SUCCESFULLY SAVED',
                'Formation'=>$data
              ]);
             }}
             } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_formation($id)
    {
    try{
         $selected=formation::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'Formation'=>$selected
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

    public function update_formation(Request $req,Formation $Formation)
    {
    try{
         //create validation
            $validate = Validator::make($req->all(), [
                'name' => 'string|max:255',
                'resume' => 'string|max:255',
                'conditions' => 'string|max:255',
                ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $Formation->update($req->all());

        if (!$Formation) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'formation SUCCESFULLY Updated',
                'Formation'=>$Formation
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_formation(Request $req,Formation $Formation)
    {
        try{
        $deleted = $Formation->delete();
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

    public function show_formations()
    {
    try{
         $itype=formation::orderBy('id', 'desc')->paginate(50);
            if(isset($itype))
            {
                return response()->json([
                    'formation'=>$itype
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
