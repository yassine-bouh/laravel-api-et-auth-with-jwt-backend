<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Family_job;

class FamilyJob extends Controller
{
  
    //***********family job

    public function create_family_job(Request $req)
    {
    try{
         //create validation
            $validate = Validator::make($req->all(), [
                'detail' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
    $data = Family_job::create($req->all());

        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'family job  SUCCESFULLY SAVED',
                'family job'=>$data 
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function read_family_job($id)
    {
    try{
            $selected= Family_job::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'family jobs'=>$selected
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

    public function update_family_job(Request $request,Family_job $Family_job)
    {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
                'detail' => 'string|max:255',
                'resume' => 'string|max:255',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
         $Family_job->update($request->all());       
        if (!$Family_job) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
            
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'family job SUCCESFULLY Updated',
                'family job'=>$Family_job
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                
            ]);
        }
    }

    public function delete_family_job(Request $req,Family_job $Family_job)
    {
    try{    $deleted = $Family_job->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'family job SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_family_jobs()
    {
         $job= Family_job::orderBy('id', 'desc')->paginate(50);
            if(isset($job))
            {
                return response()->json([
                    'family jobs'=>$job
                ]);
            }
            else 
	        {
                return response()->json([
                    'error'=>'Data Not Found',
                ]);
            }
    }


}
