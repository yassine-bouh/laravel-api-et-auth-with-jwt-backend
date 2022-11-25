<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Job_recommendation;

class JobRecommendation extends Controller
{
           //***********Job_recommendation
    public function create_job_recommendation(Request $request)
    {
        try {
                   //create validation
            $validate = Validator::make($request->all(), [
                'id_student_test' => 'required|integer',
                'id_job' => 'required|integer',
                'id_coach' => 'required|integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $sc= Job_recommendation::create($request->all());
          
               if ($sc)
               {
                    return response()->json([
                        'status' => true,
                        'message' => 'job recommendation created successfully',
                        'job recommendation' => $sc
                    ]);
                }
                else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Smoething went wrong'
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
    public function show_job_recommendations()
    {
        try {
            $sc= Job_recommendation::orderBy('id', 'desc')->paginate(50);
            return response()->json([
                'status' => true,
                'job recommendations' => $sc
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function read_job_recommendation($id)
    {
        try {
            $sc= Job_recommendation::findOrFail($id);
            return response()->json([
                'status' => true,
                'job recommendation' => $sc
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
    public function update_job_recommendation(Request $request, Job_recommendation $Job_recommendation)
    {
        try {
             //create validation
            $validate = Validator::make($request->all(), [
                'id_student_test' => 'integer',
                'id_job' => 'integer',
                'id_coach' => 'integer',
                
            ]);
            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()
                ]);
            } else {
                $result = $Job_recommendation->update($request->all());
                if ($result) {
                    return response()->json([
                        'status' => true,
                        'job' => 'job recommendation updated successfully',
                        'job recommendation' => $Job_recommendation

                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Something went wrong',
                    ]);
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete_job_recommendation(Request $request, Job_recommendation $Job_recommendation)
    {
        try {
            
            $result = $Job_recommendation->delete();
            if ($result) {
                return response()->json([
                    'status' => true,
                    'job' => 'job recommendation deleted successfully',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong',
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
   
}
