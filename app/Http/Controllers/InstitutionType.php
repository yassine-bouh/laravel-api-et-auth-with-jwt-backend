<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\institution_type;


class InstitutionType extends Controller
{
    //***********institution type

    public function create_itype(Request $req)
    {
     try{
         //create validation
            $validate = Validator::make($req->all(), [
                'private' => 'required|boolean',
                'public' => 'required|boolean',
                'admission' => 'required|boolean',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {

        $data=institution_type::create($req->all());
        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'Institution Type SUCCESFULLY SAVED',
                'Institution Type'=>$data
              ]);
             }}
             } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_itype( $id)
    {
        try{
         $selected=institution_type::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'institution type'=>$selected
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
 
    public function update_itype(Request $req,Institution_type $Institution_type)
    {
      try{
        //create validation
            $validate = Validator::make($req->all(), [
                'private' => 'boolean',
                'public' => 'boolean',
                'admission' => 'boolean',
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $Institution_type->update($req->all());

        if (!$Institution_type) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'Institution type SUCCESFULLY Updated',
                'Institution type'=>$Institution_type
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_itype(Request $req,Institution_type $Institution_type)
    {
    try{
        $deleted = $Institution_type->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'Institution Type SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_itypes()
    {
    try{
            $itype=institution_type::orderBy('id', 'desc')->paginate(50);
            if(isset($itype))
            {
                return response()->json([
                    'institution types'=>$itype
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
