<?php

namespace App\Http\Controllers;

use App\Models\institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

        //***********institution 
     public function create_institution(Request $request)
    {
    try {

     //create validation
            $validate = Validator::make($request->all(), [
                'id_institution_type' => 'required|integer',
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'website' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'phone' => 'required|string|max:20',
                'mobile' => 'required|string|max:20',
                'email' => 'required|string|max:100',
                'country' => 'required|string|max:255',
                'logo' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data=Institution::create($request->all());
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
                'institution'=>$data

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

    public function delete_institution(Request $req,Institution $Institution)
    {
    try{
        $deleted = $Institution->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'institution SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

     public function update_institution(Request $req, Institution $Institution)
     {
    try{//create validation
            $validate = Validator::make($req->all(), [
                'id_institution_type' => 'integer',
                'name' => 'string|max:255',
                'resume' => 'string|max:255',
                'website' => 'string|max:255',
                'address' => 'string|max:255',
                'city' => 'string|max:100',
                'phone' => 'string|max:20',
                'mobile' => 'string|max:20',
                'email' => 'string|max:100',
                'country' => 'string|max:255',
                'logo' => 'string|max:255',
                'contact_name' => 'string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
       
        $up= $Institution->update($req->all()); 
        if (!$up) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'institution SUCCESFULLY Updated',
                'institution'=>$Institution
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function read_institution( $id)
    {
    try{
         $selected=institution::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'institution'=>$selected
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

    public function show_institutions()
    {
    try{
         $ist=institution::orderBy('id', 'desc')->paginate(50); 
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
