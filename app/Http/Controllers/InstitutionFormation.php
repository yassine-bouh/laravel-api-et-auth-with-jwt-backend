<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\institution_formation;
use Illuminate\Support\Facades\Validator;


class InstitutionFormation extends Controller
{
    //***********institution_formation

     public function create_institution_formation(Request $req)
    {
    try {
        //create validation
            $validate = Validator::make($req->all(), [
                'id_formation' => 'required|integer',
                'id_institution' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data= Institution_formation::create($req->all());
        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'institution SUCCESFULLY SAVED',
                'institution formation'=>$data

              ]);
             }}
             } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function delete_institution_formation(Request $req,Institution_formation $Institution_formation)
    {
    try{
        $deleted = $Institution_formation->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'institution formation SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

     public function update_institution_formation(Request $req, Institution_formation $Institution_formation)
     {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
                'id_formation' => 'integer',
                'id_institution' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
         $Institution_formation->update($req->all()); 
        if (!$Institution_formation) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'institution SUCCESFULLY Updated',
                'institution formation'=>$Institution_formation
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function read_institution_formation( $id)
    {
    try{
         $selected=institution_formation::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'institution formation'=>$selected
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

    public function show_institution_formations()
    {
    try{
         $ist=institution_formation::orderBy('id', 'desc')->paginate(50);
            if(isset($ist))
            {
                return response()->json([
                    'institutions'=>$ist
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
