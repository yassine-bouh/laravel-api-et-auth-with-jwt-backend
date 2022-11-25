<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Job;

class JobController extends Controller
{
    
    
  //***********job

    public function create_job(Request $req)
    {
    try{
         //create validation
            $validate = Validator::make($req->all(), [
                'id_family_job' => 'required|integer',
                'name' => 'required|string|max:255',
                'resume' => 'required|string|max:255',
                'tasks' => 'required|string|max:255',
                'skils' => 'required|string|max:255',
                'knowlege' => 'required|string|max:255',

            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
    $data = Job::create($req->all());

        if (!$data) {
        return response()->json([
            'status'=>400,
            'error'=>'something went wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'job  SUCCESFULLY SAVED',
                'job'=>$data 
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

    public function read_job($id)
    {
    try{
            $selected= Job::findOrFail($id);
            if(isset($selected))
            {
                return response()->json([
                    'jobs'=>$selected
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

    public function update_job(Request $request,Job $Job)
    {
    try{
        //create validation
            $validate = Validator::make($req->all(), [
                'id_family_job' => 'integer',
                'name' => 'string|max:255',
                'resume' => 'string|max:255',
                'tasks' => 'string|max:255',
                'skils' => 'string|max:255',
                'knowlege' => 'string|max:255',

            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
         $Job->update($request->all());       
        if (!$Job) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
            
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'job SUCCESFULLY Updated',
                'job'=>$Job]);
             }}
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                
            ]);
        }
    }

    public function delete_job(Request $req,Job $Job)
    {
    try{    $deleted = $Job->delete();
        if (!$deleted) {
        return response()->json([
            'status'=>400,
            'error'=>'Something Went Wrong',
        ]);
        }
        else {
	          return response()->json([
                'status'=>200,
                'message'=>'job SUCCESFULLY Deleted']);
             }
    } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_jobs()
    {
         $job=Job::orderBy('id', 'desc')->paginate(50);
            if(isset($job))
            {
                return response()->json([
                    'jobs'=>$job
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
