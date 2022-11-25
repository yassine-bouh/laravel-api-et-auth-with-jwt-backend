<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Job_degree;

class JobDegree extends Controller
{
    
//***********Job_degree

    public function create_job_degree(Request $req)
    {
    try{
         //create validation
            $validate = Validator::make($req->all(), [
                'id_job' => 'required|integer',
                'id_degree' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
        $data= Job_degree::create($req->all());

        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'job degree SUCCESFULLY SAVED',
                'Job degree'=>$data
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

    public function read_job_degree($id)
    {
    try{
            $selected= Job_degree::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'Job degree'=>$selected
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

    public function update_job_degree(Request $request,Job_degree $Job_degree)
    {
    try{
         //create validation
            $validate = Validator::make($req->all(), [
                'id_job' => 'integer',
                'id_degree' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
      $Job_degree->update($request->all());       
        if (!$Job_degree) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
            
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'job SUCCESFULLY Updated',
                'job degree'=>$Job_degree
              ]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                
            ]);
        }
    }

    public function delete_job_degree(Request $req,Job_degree $Job_degree)
    {
    try{    $deleted = $Job_degree->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'job degree SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_job_degrees()
    {
         $job=Job_degree::orderBy('id', 'desc')->paginate(50);
            if(isset($job))
            {
                return response()->json([
                    'job degrees '=>$job
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
